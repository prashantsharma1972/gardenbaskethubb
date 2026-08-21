const fs = require('fs');
const path = require('path');

const dir = 'D:/Local Sites/gardenbaskethubb/app/public/wp-content/themes/gardenbaskethubb';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.php'));

files.forEach(file => {
    // Skip non-template files
    if (['functions.php', 'header.php', 'footer.php', 'style.css'].includes(file)) return;

    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // Only process if it has get_header() and get_footer()
    if (content.includes('get_header();') && content.includes('get_footer();')) {
        
        // If it doesn't have <main class="main--container">
        if (!content.includes('<main class="main--container">')) {
            // Replace <?php get_header(); ?> with <?php get_header(); ?>\n<main class="main--container">
            content = content.replace(/(<\?php\s*get_header\(\);\s*\?>)/, '$1\n<main class="main--container">');
            
            // Replace <?php get_footer(); ?> with </main>\n<?php get_footer(); ?>
            content = content.replace(/(<\?php\s*get_footer\(\);\s*\?>)/, '</main>\n$1');
            
            fs.writeFileSync(filePath, content, 'utf8');
            console.log('Added main wrapper to', file);
        }
    }
});
