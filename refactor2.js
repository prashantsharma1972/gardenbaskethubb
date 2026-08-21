const fs = require('fs');
const path = require('path');

const dir = 'D:/Local Sites/gardenbaskethubb/app/public/wp-content/themes/gardenbaskethubb';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.php'));

const keepTemplateName = [
    'page-about-us.php',
    'page-contact-us.php',
    'page-cart.php',
    'page-checkout.php',
    'page-success.php',
    'page-thank-you.php',
    'page-terms-and-conditions.php',
    'privacy-policy.php',
    'page-refund-policy.php'
];

files.forEach(file => {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // Remove the <?php /* ... */ ?> block if not in keepTemplateName
    if (!keepTemplateName.includes(file)) {
        content = content.replace(/^<\?php\s*\/\*\*[\s\S]*?\*\/\s*\?>\s*/, '');
    }

    // Replace <?php echo esc_url(home_url('/shop/')); ?> with /shop/
    content = content.replace(/<\?php\s*echo\s*esc_url\(home_url\('([^']+)'\)\);\s*\?>/g, '$1');
    
    // Replace <?php echo esc_url(gbh_get_page_url('something')); ?> with /something/
    content = content.replace(/<\?php\s*echo\s*esc_url\(gbh_get_page_url\('([^']+)'\)\);\s*\?>/g, '/$1/');

    fs.writeFileSync(filePath, content, 'utf8');
});

console.log('Refactor 2 complete');
