public class Lab {
    public static class BST {
        class Node {
            int key;
            Node left, right;

            public Node(int data) {
                key = data;
                left = right = null;
            }
        }

        Node root;
        BST() {
            root = null;
        }

    public void remove(int key) {
        root = deleteNode(root, key);
    }

    Node deleteNode(Node root, int key) {
        // if root is null which means we reached end of tree.
        if (root == null) {
            return root;
        }

        // traverse the tree
        // if key is less than current root, traverse the left subtree
        if (key < root.key) {
            root.left = deleteNode(root.left, key);

        // if key is greater than current root, traverse the right subtree    
        } else if (key > root.key) { 
            root.right = deleteNode(root.right, key);
        } else {

            // node contains only one child
            // if root has no left child, return right
            if (root.left == null) {
                return root.right;
            // if root has no right child, return left
            } else if (root.right == null) {
                return root.left;
            }

            // node has two children;
            // get inorder successor (min value in the right subtree)
            root.key = min(root.right);

            // Call method and delete the inorder successor
            root.right = deleteNode(root.right, root.key);
        }
        return root;
    }

// return minimum value key in tree
    int min(Node root) {
        // initially minval = root (starting point)
        int minval = root.key;
        // find minval by continuing as long as root is not null
        while (root.left != null) {
            // update minval to key of left child and update root node to left child node
            // traverse down the left side
            minval = root.left.key;
            root = root.left;
        }
        return minval;
    }

    void insert(int key) {
        root = insertNode(root, key);
    }

    Node insertNode(Node root, int key) {
        // if tree is empty, insert new node and return it
        if (root == null) {
            root = new Node(key);
            return root;
        }

        // if key is less than root, insert node in left subtree
        else if (key < root.key)
            root.left = insertNode(root.left, key);
        // if key is greater than root, insert node in right subtree
        else if (key > root.key)
            root.right = insertNode(root.right, key);

        // return root of the current subtree that has an updated node
        return root;
    }

// pass the root node and key value, if present return true, otherwise return false
    boolean search(int key) {
        if (searchTree(root, key) != null) {
            return true;
        } else {
            return false;
        }
    }

    // recursive insert function
    private Node searchTree(Node root, int key) {
        // Base Cases: root is null or key is present at root
        if (root == null || root.key == key) {
            return root;
        }
        // value is greater than root's key
        if (root.key > key) {
            return searchTree(root.left, key);
        }
        // value is less than root's key
        return searchTree(root.right, key);
    }

// check left subtree first, print the current node's value and check right subtree
// key values of the nodes are printed in ascending order   
    void inOrderTraversal(Node root) {
        if (root != null) {
            inOrderTraversal(root.left);
            System.out.print(root.key + " ");
            inOrderTraversal(root.right);
        }
    }
}

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 4:
// insert 15 nodes using insert method and "inOrderTraversal" method is called
// print the nodes in ascending order
    public static void main(String[] args) {

        BST tree = new BST();
        long start, end;

        System.out.println("Inserting");
        for (int i = 1; i <= 15; i++) {
            tree.insert(i);
        }
        System.out.println();

        System.out.println("Traversing");
        tree.inOrderTraversal(tree.root);
        System.out.println();
        System.out.println();
        
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 5:
// for loop runs 100000 times and calls search method each time with an argument of 1 in the first tree
// subtract start time and end time to get the full time it takes to traverse
        System.out.println("Searching for 1 100000 times");
        start = System.nanoTime();
        for (int i = 1; i <= 100000; i++) {
            tree.search(1);
        }
        end = System.nanoTime();
        System.out.println("Time: " + (end - start) + " nanoseconds");
        System.out.println();

// for loop runs 100000 times and calls search method each time with an argument of 15 in the first tree
// subtract start timem and end time to get the full time it takes to traverse        
        System.out.println("Searching for 15 100000 times");
        start = System.nanoTime();
        for (int i = 1; i <= 100000; i++) {
            tree.search(15);
        }
        end = System.nanoTime();
        System.out.println("Time: " + (end - start) + " nanoseconds");
        System.out.println();

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 6:
// prints "Removing 5" to indicate which node with key 5 will be removed
// call "remove" method which removes key 5 from the tree
// call "inOrderTraversal" method and print the keys in sorted order after removal
// print a blank line for formatting purposes
        System.out.println("Removing 5");
        tree.remove(5);
        tree.inOrderTraversal(tree.root);
        System.out.println();

        System.out.println("Removing 15");
        tree.remove(15);
        tree.inOrderTraversal(tree.root);
        System.out.println();

        System.out.println("Removing 1");
        tree.remove(1);
        tree.inOrderTraversal(tree.root);
        System.out.println();

        System.out.println("Inserting 2");
        tree.insert(2);
        tree.inOrderTraversal(tree.root);
        System.out.println();
        System.out.println();

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 7:
// creates new tree, inserts elements and calls "inOrderTraversal" method and the prints the output in order of (left, root, right)
        System.out.println("Creating new tree");
        BST tree2 = new BST();
        System.out.println();

        System.out.println("Inserting");
        tree2.insert(8);
        tree2.insert(4);
        tree2.insert(12);
        tree2.insert(2);
        tree2.insert(6);
        tree2.insert(10);
        tree2.insert(14);
        tree2.insert(1);
        tree2.insert(3);
        tree2.insert(5);
        tree2.insert(7);
        tree2.insert(9);
        tree2.insert(11);
        tree2.insert(13);
        tree2.insert(15);
        System.out.println();

        System.out.println("Traversing");
        tree2.inOrderTraversal(tree2.root);
        System.out.println();
        System.out.println();


// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 8:
// for loop runs 100000 times and calls search method each time with an argument of 1 in the second tree
// subtract start timem and end time to get the full time it takes to traverse
        System.out.println("Searching for 1 100000 times");
        start = System.nanoTime();
        for (int i = 1; i <= 100000; i++) {
            tree2.search(1);
        }
        end = System.nanoTime();
        System.out.println("Time: " + (end - start) + " nanoseconds");
        System.out.println();

// for loop runs 100000 times and calls search method each time with an argument of 15 in the second tree
// subtract start timem and end time to get the full time it takes to traverse  
        System.out.println("Searching for 15 100000 times");
        start = System.nanoTime();
        for (int i = 1; i <= 100000; i++) {
            tree2.search(15);
        }
        end = System.nanoTime();
        System.out.println("Time: " + (end - start) + " nanoseconds");
        System.out.println();

// prints "Removing 8" to indicate which node with key 8 will be removed
// call "remove" method which removes key 8 from the tree
// call "inOrderTraversal" method and print the keys in sorted order after removal
// print a blank line for formatting purposes
        System.out.println("Removing 8");
        tree2.remove(8);
        tree2.inOrderTraversal(tree2.root);
        System.out.println();
    }
}