-- CreatorKart Gear MySQL schema and seed data
SET NAMES utf8mb4;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS quote_requests;
DROP TABLE IF EXISTS service_requests;
DROP TABLE IF EXISTS site_settings;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(120) NOT NULL UNIQUE,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(80) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    summary VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    option1_name VARCHAR(100) NOT NULL,
    option1_values VARCHAR(255) NOT NULL,
    option2_name VARCHAR(100) NOT NULL,
    option2_values VARCHAR(255) NOT NULL,
    video_file VARCHAR(255) NOT NULL,
    audio_file VARCHAR(255) NOT NULL,
    is_featured TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_number VARCHAR(60) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    shipping_address TEXT NOT NULL,
    order_notes TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Processing',
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    option_one VARCHAR(100) NOT NULL,
    option_two VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_reviews_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    CONSTRAINT fk_reviews_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL DEFAULT 0,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    subject VARCHAR(190) NOT NULL,
    message TEXT NOT NULL,
    attachment_name VARCHAR(255) NULL,
    admin_response TEXT NULL,
    status VARCHAR(40) NOT NULL DEFAULT 'New',
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    category VARCHAR(80) NOT NULL,
    budget DECIMAL(10,2) NOT NULL,
    option_one VARCHAR(120) NULL,
    option_two VARCHAR(120) NULL,
    notes TEXT NULL,
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE site_settings (
    setting_key VARCHAR(80) PRIMARY KEY,
    setting_value VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO users (full_name, email, password_hash, role, is_active, created_at) VALUES
('Site Administrator', 'admin@creatorkart.local', '$2y$12$iwwX7zVGBefzQRwIDr4AM.7nTe5SogXiRUEN89s.Qn.jCRSgckR8G', 'admin', 1, NOW()),
('Demo Customer', 'customer@creatorkart.local', '$2y$12$iwwX7zVGBefzQRwIDr4AM.7nTe5SogXiRUEN89s.Qn.jCRSgckR8G', 'customer', 1, NOW());

INSERT INTO products (slug, name, category, price, summary, description, image, stock, option1_name, option1_values, option2_name, option2_values, video_file, audio_file, is_featured, created_at) VALUES
('pixel-rush-keyboard', 'Pixel Rush Keyboard', 'Keyboards', 89.99, 'Hot-swappable mechanical keyboard with creator macros.', 'Built for gaming setups and creator desks, the Pixel Rush Keyboard combines tactile switches, hot-swappable sockets, per-key RGB, and macro-ready controls. It is ideal for streamers, students, and anyone who wants a polished desk setup.', 'assets/img/products/product-01.svg', 20, 'Switch Type', 'Linear|Tactile', 'Colourway', 'Blackout|Ice White', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 1, NOW()),
('nova-type-65', 'Nova Type 65', 'Keyboards', 109.99, 'Compact 65% board with gasket mount and quiet acoustics.', 'The Nova Type 65 is designed for users who want a compact footprint without losing arrow keys. It features a gasket-style frame, premium dampening, and a refined typing feel for long study or editing sessions.', 'assets/img/products/product-02.svg', 6, 'Switch Type', 'Silent Linear|Clicky', 'Case Finish', 'Midnight|Silver', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 1, NOW()),
('drift-mouse-pro', 'Drift Mouse Pro', 'Mice', 59.99, 'Lightweight gaming mouse with adjustable DPI profiles.', 'The Drift Mouse Pro balances speed, comfort, and accuracy. With programmable buttons and adjustable DPI presets, it works equally well for gaming, productivity, and editing workflows.', 'assets/img/products/product-03.svg', 10, 'Grip Style', 'Palm|Claw', 'Shell Colour', 'Black|White', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 1, NOW()),
('arc-desk-mat', 'Arc Desk Mat', 'Desk Accessories', 24.99, 'Extended desk mat with stitched edges and anti-slip base.', 'The Arc Desk Mat brings visual polish and mouse consistency to a desk setup. It protects surfaces, improves glide, and is easy to clean, making it a simple upgrade for any workstation.', 'assets/img/products/product-04.svg', 25, 'Size', 'Large|XL', 'Theme', 'Graphite|Sunset', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 1, NOW()),
('framewave-webcam', 'FrameWave Webcam', 'Cameras', 74.99, '1080p webcam with privacy shutter and low-light mode.', 'FrameWave Webcam is tailored for class calls, streaming, and team meetings. It includes a built-in privacy shutter, low-light correction, and a simple clip mount for monitors or tripods.', 'assets/img/products/product-05.svg', 17, 'Resolution', '1080p|2K', 'Mount Style', 'Monitor Clip|Mini Tripod', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 1, NOW()),
('echoforge-mic', 'EchoForge Microphone', 'Audio', 129.99, 'USB condenser mic for streaming, voiceovers, and calls.', 'EchoForge Microphone delivers clear voice capture for content creators, students, and remote workers. It includes cardioid pickup, desk stand support, and simple plug-and-play USB connectivity.', 'assets/img/products/product-06.svg', 12, 'Bundle', 'Mic Only|Mic + Boom Arm', 'Finish', 'Matte Black|Arctic White', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 1, NOW()),
('pulsecore-headset', 'PulseCore Headset', 'Audio', 79.99, 'Closed-back gaming headset with detachable mic.', 'PulseCore Headset is built for long sessions with soft ear cushions, a detachable mic, and strong directional audio. It is ideal for gaming nights, classes, and collaborative calls.', 'assets/img/products/product-07.svg', 26, 'Connection', '3.5mm|USB', 'Accent Colour', 'Blue|Red', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 0, NOW()),
('snapcast-capture', 'SnapCast Capture Card', 'Streaming', 139.99, 'USB capture card for consoles and cameras.', 'SnapCast Capture is a creator-focused capture card for clean gameplay and camera passthrough. It supports plug-and-play workflows for students, streamers, and side-hustle creators.', 'assets/img/products/product-08.svg', 25, 'Input', 'HDMI|HDMI + Mic In', 'Bundle', 'Card Only|Creator Kit', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 0, NOW()),
('luma-desk-lamp', 'Luma Desk Lamp', 'Lighting', 44.99, 'Adjustable LED lamp with warm and cool modes.', 'The Luma Desk Lamp improves desk lighting for study, streaming, and recording. Its adjustable brightness and colour temperature make it easy to create a clean, eye-friendly workspace.', 'assets/img/products/product-09.svg', 32, 'Control Type', 'Touch|Remote', 'Colour', 'Black|White', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 0, NOW()),
('vertex-chair', 'Vertex Chair', 'Furniture', 219.99, 'Ergonomic gaming and study chair with lumbar support.', 'Vertex Chair provides a comfortable, structured seat for long study sessions, editing work, or gaming marathons. It includes adjustable armrests, lumbar support, and durable upholstery.', 'assets/img/products/product-10.svg', 23, 'Upholstery', 'Fabric|PU Leather', 'Colourway', 'Carbon|Storm Blue', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 0, NOW()),
('gridline-desk', 'Gridline Desk', 'Furniture', 259.99, 'Clean workstation desk with cable tray and grommets.', 'Gridline Desk is a minimalist workstation built for organized setups. It offers generous surface area, integrated cable routing, and a sturdy frame for monitors, mics, and accessories.', 'assets/img/products/product-11.svg', 9, 'Desk Width', '48 inch|60 inch', 'Finish', 'Oak|Black', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 0, NOW()),
('turbo-pad-controller', 'TurboPad Controller', 'Controllers', 54.99, 'Wireless controller for PC and console setups.', 'TurboPad Controller blends comfort and fast connectivity in a versatile gamepad. It is a strong pick for racing, platformers, and couch play sessions.', 'assets/img/products/product-12.svg', 14, 'Connectivity', 'Bluetooth|2.4 GHz Dongle', 'Colourway', 'Cosmic Black|Retro Purple', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 0, NOW()),
('retro-pocket-console', 'Retro Pocket Console', 'Handhelds', 149.99, 'Portable retro-inspired gaming handheld.', 'Retro Pocket Console is a compact handheld designed for travel and nostalgia. It offers a bright display, responsive controls, and enough battery life for casual sessions between classes or trips.', 'assets/img/products/product-13.svg', 21, 'Storage', '64 GB|128 GB', 'Shell', 'Transparent Smoke|Solid Grey', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 0, NOW()),
('vault-ssd', 'Vault SSD', 'Storage', 69.99, 'Fast external SSD for clips, backups, and projects.', 'Vault SSD helps creators and students carry projects, footage, and backups with confidence. It is light, fast, and ideal for editing libraries or transferring assignments between machines.', 'assets/img/products/product-14.svg', 20, 'Capacity', '500 GB|1 TB', 'Finish', 'Slate|Blue', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 0, NOW()),
('halo-monitor-light', 'Halo Monitor Light', 'Lighting', 49.99, 'Clip-on monitor lamp with glare-controlled beam.', 'Halo Monitor Light adds focused desk lighting without taking up surface space. It is ideal for reducing eye strain while keeping a clean monitor-centered setup.', 'assets/img/products/product-15.svg', 18, 'Power', 'USB-C|USB-A', 'Colour', 'Black|Silver', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 0, NOW()),
('switchwave-hub', 'SwitchWave Hub', 'Accessories', 39.99, 'HDMI switch for creator and multi-console desks.', 'SwitchWave Hub is a convenient HDMI switch for users juggling multiple inputs. It keeps desks tidy and makes it easy to alternate between console, laptop, and capture workflows.', 'assets/img/products/product-16.svg', 16, 'Ports', '3-in-1-out|5-in-1-out', 'Control', 'Manual|Remote', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 0, NOW()),
('tower-vertical-stand', 'Tower Vertical Stand', 'Accessories', 34.99, 'Space-saving stand for laptops and consoles.', 'Tower Vertical Stand helps free up desk space and improve cable management. It supports slim laptops, small desktops, and consoles with padded contact points for protection.', 'assets/img/products/product-17.svg', 20, 'Fit', 'Laptop|Console', 'Finish', 'Black|Aluminum', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 0, NOW()),
('macrodeck-mini', 'MacroDeck Mini', 'Streaming', 99.99, 'Programmable macro pad for stream scenes and shortcuts.', 'MacroDeck Mini simplifies repetitive actions for creators, editors, and multitaskers. Trigger scenes, launch apps, and automate common tasks with tactile programmable keys.', 'assets/img/products/product-18.svg', 12, 'Keys', '6 Keys|12 Keys', 'Lighting', 'RGB|Monochrome', 'assets/media/showcase-3.mp4', 'assets/media/audio-3.wav', 0, NOW()),
('roomtone-speakers', 'RoomTone Speakers', 'Audio', 89.99, 'Compact desktop speakers for games and editing.', 'RoomTone Speakers deliver clean sound in a compact desktop form. They are well-suited for music playback, casual gaming, and general editing or class content.', 'assets/img/products/product-19.svg', 12, 'Connection', 'Bluetooth|Wired', 'Colour', 'Black|Walnut', 'assets/media/showcase-1.mp4', 'assets/media/audio-1.wav', 0, NOW()),
('cable-keeper-kit', 'Cable Keeper Kit', 'Desk Accessories', 19.99, 'Cable management starter kit for clean setups.', 'Cable Keeper Kit is a simple but effective desk upgrade. It includes clips, sleeves, and ties to organize charging, audio, and monitor cables without complicated installation.', 'assets/img/products/product-20.svg', 17, 'Kit Size', 'Starter|Deluxe', 'Colour', 'Black|White', 'assets/media/showcase-2.mp4', 'assets/media/audio-2.wav', 0, NOW());

INSERT INTO site_settings (setting_key, setting_value) VALUES
('active_theme', 'classic');


INSERT INTO reviews (product_id, user_id, rating, comment, created_at) VALUES
(1, 2, 5, 'Excellent keyboard for study sessions and gameplay.', NOW()),
(3, 2, 4, 'Very comfortable and responsive mouse.', NOW()),
(6, 2, 5, 'Clear voice capture and easy setup.', NOW());


INSERT INTO orders (user_id, order_number, total_amount, shipping_address, order_notes, status, created_at) VALUES
(2, 'CK-20260324-1001', 149.98, '2453 Tranquility Ave, Windsor, ON', 'Demo order for grading.', 'Delivered', NOW());


INSERT INTO order_items (order_id, product_id, product_name, option_one, option_two, quantity, unit_price) VALUES
(1, 1, 'Pixel Rush Keyboard', 'Linear', 'Blackout', 1, 89.99),
(1, 4, 'Arc Desk Mat', 'Large', 'Graphite', 1, 24.99),
(1, 20, 'Cable Keeper Kit', 'Starter', 'Black', 1, 19.99);


INSERT INTO service_requests (user_id, full_name, email, subject, message, attachment_name, admin_response, status, created_at) VALUES
(2, 'Demo Customer', 'customer@creatorkart.local', 'Shipping question', 'Can I change my shipping address after checkout?', '', 'Yes. Admin can update the address before shipment.', 'Answered', NOW());
