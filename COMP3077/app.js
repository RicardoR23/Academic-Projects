/*
 * CreatorKart Gear main JavaScript
 * ----------------------------------------------------------
 * Handles:
 * - mobile navigation toggle
 * - quote builder live preview
 * - category bar chart rendering
 */

document.addEventListener('DOMContentLoaded', () => {
    // Responsive menu toggle for smaller screens.
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.getElementById('main-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    // Dynamic quote preview that reacts to category and budget.
    const quoteForm = document.getElementById('quoteForm');
    if (quoteForm) {
        const categorySelect = document.getElementById('quoteCategory');
        const budgetRange = document.getElementById('budgetRange');
        const budgetOutput = document.getElementById('budgetOutput');

        const previewCategory = document.querySelector('[data-preview="category"]');
        const previewBudget = document.querySelector('[data-preview="budget"]');
        const previewTier = document.querySelector('[data-preview="tier"]');
        const previewItems = document.querySelector('[data-preview="items"]');

        const renderPreview = () => {
            const budget = Number(budgetRange.value || 200);
            budgetOutput.textContent = `$${budget}`;
            previewCategory.textContent = categorySelect.value;
            previewBudget.textContent = `$${budget}`;

            let tier = 'Balanced mid-range bundle';
            let items = 3;

            if (budget < 120) {
                tier = 'Starter bundle';
                items = 2;
            } else if (budget >= 120 && budget < 280) {
                tier = 'Balanced mid-range bundle';
                items = 3;
            } else {
                tier = 'Advanced creator bundle';
                items = 4;
            }

            previewTier.textContent = tier;
            previewItems.textContent = String(items);
        };

        categorySelect.addEventListener('change', renderPreview);
        budgetRange.addEventListener('input', renderPreview);
        renderPreview();
    }

    // Canvas bar chart for category totals.
    const chart = document.getElementById('categoryChart');

    if (chart) {
        const labels = JSON.parse(chart.dataset.labels || '[]');
        const values = JSON.parse(chart.dataset.values || '[]');
        const ctx = chart.getContext('2d');

        const width = chart.width;
        const height = chart.height;
        const padding = 36;
        const chartHeight = height - padding * 2;
        const chartWidth = width - padding * 2;
        const maxValue = Math.max(...values, 1);
        const barWidth = chartWidth / Math.max(values.length, 1) * 0.7;

        ctx.clearRect(0, 0, width, height);
        ctx.font = '14px Arial';
        ctx.fillStyle = '#475569';
        ctx.strokeStyle = '#cbd5e1';

        // Axis
        ctx.beginPath();
        ctx.moveTo(padding, padding);
        ctx.lineTo(padding, height - padding);
        ctx.lineTo(width - padding, height - padding);
        ctx.stroke();

        values.forEach((value, index) => {
            const x = padding + index * (chartWidth / values.length) + 12;
            const barHeight = (value / maxValue) * (chartHeight - 18);
            const y = height - padding - barHeight;

            ctx.fillStyle = index % 2 === 0 ? '#1d4ed8' : '#f97316';
            ctx.fillRect(x, y, barWidth, barHeight);

            ctx.fillStyle = '#0f172a';
            ctx.fillText(String(value), x + 8, y - 8);

            ctx.save();
            ctx.translate(x + barWidth / 2, height - padding + 16);
            ctx.rotate(-0.45);
            ctx.fillStyle = '#334155';
            ctx.fillText(labels[index], 0, 0);
            ctx.restore();
        });
    }
});
