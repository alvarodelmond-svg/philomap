
const fs = require('fs');
const path = require('path');

const files = process.argv.slice(2);

files.forEach(filePath => {
    if (!fs.existsSync(filePath)) return;
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Multiple footers: Keep only the last one
    // Find all footers
    const footerRegex = /<footer[\s\S]*?<\/footer>/gi;
    let matches = [];
    let match;
    while ((match = footerRegex.exec(content)) !== null) {
        matches.push({
            index: match.index,
            length: match[0].length,
            text: match[0]
        });
    }

    if (matches.length > 1) {
        // Keep only the last footer
        const lastFooter = matches[matches.length - 1];
        
        // Build new content by removing previous footers
        let newContent = '';
        let lastIndex = 0;
        for (let i = 0; i < matches.length - 1; i++) {
            newContent += content.substring(lastIndex, matches[i].index);
            lastIndex = matches[i].index + matches[i].length;
        }
        newContent += content.substring(lastIndex);
        content = newContent;
    }

    // Now re-fetch the last footer after removal
    // (There should only be one now, or zero)
    
    // 2. Change all inline text-align to justify in relevant elements
    const textElements = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'footer', 'blockquote', 'div', 'span', 'section', 'header', 'aside'];
    const tagRegex = new RegExp(`(<(${textElements.join('|')})\\b[^>]*?\\bstyle=")([^"]*)(")`, 'gi');
    
    content = content.replace(tagRegex, (match, start, tagName, style, end) => {
        // Skip buttons or things that look like buttons
        const lowerMatch = match.toLowerCase();
        if (lowerMatch.includes('btn') || lowerMatch.includes('button')) {
            return match;
        }
        
        if (/text-align\s*:\s*[^;]+/i.test(style)) {
            style = style.replace(/text-align\s*:\s*[^;]+/gi, 'text-align: justify');
        } else {
            const primarilyText = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'footer', 'blockquote'];
            if (primarilyText.includes(tagName.toLowerCase())) {
                style = style.trim();
                if (style && !style.endsWith(';')) style += ';';
                style += ' text-align: justify;';
            }
        }
        return start + style + end;
    });

    // 3. Ensure the footer has no bottom margin/padding and is justified
    content = content.replace(/(<footer\b[^>]*?)(>)/gi, (match, start, end) => {
        if (start.includes('style="')) {
            return start.replace(/style="([^"]*)"/i, (sMatch, style) => {
                if (!/text-align/i.test(style)) style += '; text-align: justify;';
                else style = style.replace(/text-align\s*:\s*[^;]+/gi, 'text-align: justify');
                
                style = style.replace(/padding-bottom\s*:\s*[^;]+/gi, '').trim();
                style = style.replace(/margin-bottom\s*:\s*[^;]+/gi, '').trim();
                
                if (style && !style.endsWith(';')) style += ';';
                style += ' padding-bottom: 0; margin-bottom: 0;';
                
                return `style="${style}"`;
            }) + end;
        } else {
            return `${start} style="text-align: justify; padding-bottom: 0; margin-bottom: 0;"${end}`;
        }
    });

    // 4. Remove empty elements at the end
    let bodyEndIndex = content.lastIndexOf('</body>');
    if (bodyEndIndex === -1) bodyEndIndex = content.length;
    
    let endPart = content.substring(0, bodyEndIndex);
    let restPart = content.substring(bodyEndIndex);
    
    while (true) {
        let trimmedEnd = endPart.trimEnd();
        let m = trimmedEnd.match(/<(p|li|div|span|ul|ol)\b[^>]*?>(\s|&nbsp;)*<\/\1>$/i);
        if (m) {
            endPart = trimmedEnd.substring(0, trimmedEnd.length - m[0].length);
        } else {
            let brMatch = trimmedEnd.match(/<br\s*\/?>$/i);
            if (brMatch) {
                endPart = trimmedEnd.substring(0, trimmedEnd.length - brMatch[0].length);
            } else {
                break;
            }
        }
    }
    
    content = endPart + restPart;

    fs.writeFileSync(filePath, content, 'utf8');
});
