const fs = require('fs');
const path = require('path');

const directoryPath = path.join(__dirname);

function processDirectory(dir) {
    const files = fs.readdirSync(dir);
    
    files.forEach(file => {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            if (file !== 'node_modules' && file !== '.git' && file !== 'build' && file !== 'public') {
                processDirectory(fullPath);
            }
        } else if (file.endsWith('.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;

            // Remove standard PHP docblocks at the start of files
            content = content.replace(/^<\?php\s*\/\*\*[\s\S]*?\*\/\s*\?>\s*/, '');
            
            // Replace <html <?php language_attributes(); ?>> with <html lang="en">
            content = content.replace(/<html[^>]*<\?php\s*language_attributes\(\);\s*\?>[^>]*>/g, '<html lang="en">');
            
            // Just in case it's in two parts
            content = content.replace(/<\?php\s*language_attributes\(\);\s*\?>/g, 'lang="en"');
            
            // Replace <?php echo esc_url(home_url('/shop/')); ?> with /shop/
            // Replace <?php echo esc_url(home_url('/')); ?> with /
            // General regex for esc_url(home_url('...'))
            content = content.replace(/<\?php\s*echo\s*esc_url\s*\(\s*home_url\s*\(\s*(['"])(.*?)\1\s*\)\s*\)\s*;\s*\?>/g, (match, quote, urlPath) => {
                // if it's '/' make sure we return '/', if it's '/shop/' return '/shop/'
                return urlPath.startsWith('/') ? urlPath : '/' + urlPath;
            });
            
            // For parameterless home_url()
            content = content.replace(/<\?php\s*echo\s*esc_url\s*\(\s*home_url\s*\(\s*\)\s*\)\s*;\s*\?>/g, '/');

            // Replace <?php echo home_url('/...'); ?>
            content = content.replace(/<\?php\s*echo\s*home_url\s*\(\s*(['"])(.*?)\1\s*\)\s*;\s*\?>/g, (match, quote, urlPath) => {
                return urlPath.startsWith('/') ? urlPath : '/' + urlPath;
            });

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated: ${file}`);
            }
        }
    });
}

processDirectory(directoryPath);
console.log('Done!');
