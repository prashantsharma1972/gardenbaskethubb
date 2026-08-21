const fs = require('fs');
const path = require('path');

const dir = 'D:/Local Sites/gardenbaskethubb/app/public/wp-content/themes/gardenbaskethubb';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.php'));

files.forEach(file => {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Replace <html> and <meta> tags
    content = content.replace(/<html <\?php language_attributes\(\); \?>>\s*<head>\s*<meta charset="<\?php bloginfo\('charset'\); \?>">\s*<meta name="viewport" content="width=device-width, initial-scale=1\.0, maximum-scale=1\.0, user-scalable=no">/g,
        '<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">');
    
    // Also handle variations
    content = content.replace(/<html <\?php language_attributes\(\); \?>>/g, '<html lang="en">');
    content = content.replace(/<meta charset="<\?php bloginfo\('charset'\); \?>">/g, '<meta charset="UTF-8">');
    content = content.replace(/<meta name="viewport" content="width=device-width, initial-scale=1\.0, maximum-scale=1\.0, user-scalable=no">/g, '<meta name="viewport" content="width=device-width, initial-scale=1.0">');

    // 2. CSS link
    content = content.replace(/<link rel="stylesheet" href="<\?php echo get_template_directory_uri\(\); \?>\/build\/([^/]+)\/\1\.css">/g,
        '<link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/$1/$1.css">\n    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/$1/$1.css">');
    
    // 3. JS link
    content = content.replace(/<script type="module" defer src="<\?php echo get_template_directory_uri\(\); \?>\/build\/([^/]+)\/\1\.bundle\.js"><\/script>/g,
        '<script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/$1/$1.bundle.js"></script>');
    
    // Handle the user's auto-formatted versions for script (where src might be on next line)
    content = content.replace(/<script type="module" defer\s*src="<\?php echo get_template_directory_uri\(\); \?>\/build\/([^/]+)\/\1\.bundle\.js"><\/script>/g,
        '<script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/$1/$1.bundle.js"></script>');

    // 4. home_url
    content = content.replace(/<\?php echo esc_url\(home_url\('([^']+)'\)\); \?>/g, '$1');

    fs.writeFileSync(filePath, content, 'utf8');
});

console.log('Done refactoring');
