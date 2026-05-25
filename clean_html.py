
import os
import glob
import re

# Get all HTML files in the specified directories
files = glob.glob('index.html') + glob.glob('html/*.html') + glob.glob('conteúdo/*.html') + glob.glob('public/*.html')

# Some systems might have duplicates if directories are overlapping or symlinked
files = list(set(os.path.abspath(f) for f in files))

for file_path in files:
    if not os.path.isfile(file_path):
        continue
    
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
    except UnicodeDecodeError:
        try:
            with open(file_path, 'r', encoding='latin-1') as f:
                content = f.read()
        except:
            print(f"Could not read {file_path}")
            continue

    # 1. Remove empty elements at the very end of <body> or <main>
    # Also handle whitespaces between tags
    
    # Identify the last tag before closing main or body
    main_match = re.search(r'([\s\S]*?)(</main>)', content, re.IGNORECASE)
    body_match = re.search(r'([\s\S]*?)(</body>)', content, re.IGNORECASE)
    
    if main_match:
        before = main_match.group(1)
        after = main_match.group(2) + content[main_match.end():]
    elif body_match:
        before = body_match.group(1)
        after = body_match.group(2) + content[body_match.end():]
    else:
        continue

    # Repeatedly remove empty tags from the end of 'before'
    while True:
        # Matches <tag ...></tag> or <br ...> at the very end, possibly followed by whitespace
        new_before = re.sub(r'<(p|div|li|span|br|section)[^>]*>\s*(</\1>)?\s*$', '', before, flags=re.IGNORECASE)
        if new_before == before:
            break
        before = new_before
    
    content = before + after

    # 2. Update footer.app-footer and its <p>
    def process_footer(match):
        footer_open = match.group(1)
        footer_inner = match.group(2)
        
        # Ensure footer has the required inline style
        if 'style="' in footer_open:
            # Update existing style
            footer_open = re.sub(r'style="([^"]*)"', 
                                 lambda m: 'style="' + re.sub(r'(margin|padding)-bottom:[^;!]+(!important)?;?', '', m.group(1)).strip().rstrip(';') + '; margin-bottom: 0 !important; padding-bottom: 0 !important;"', 
                                 footer_open)
        else:
            # Add new style
            footer_open = footer_open.rstrip('>') + ' style="margin-bottom: 0 !important; padding-bottom: 0 !important;">'
            
        # Update <p> inside footer
        if '<p' in footer_inner:
            footer_inner = re.sub(r'<p([^>]*)>', 
                                  lambda m: '<p' + (re.sub(r'style="([^"]*)"', 
                                                           lambda m2: 'style="' + re.sub(r'margin-bottom:[^;!]+(!important)?;?', '', m2.group(1)).strip().rstrip(';') + '; margin-bottom: 0 !important;"', 
                                                           m.group(1)) if 'style="' in m.group(1) else m.group(1).rstrip('>') + ' style="margin-bottom: 0 !important;">'), 
                                  footer_inner)
        
        return footer_open + footer_inner + '</footer>'

    content = re.sub(r'(<footer[^>]*class="[^"]*app-footer[^"]*"[^>]*>)([\s\S]*?)</footer>', process_footer, content, flags=re.IGNORECASE)

    # 3. Check for any elements with large bottom margins or paddings at the end of the content and set them to 0.
    # We'll look for the last significant tag before the footer and force its bottom margin to 0 if it has an inline style
    
    def zero_last_margin(match):
        before_tag = match.group(1)
        tag_name = match.group(2)
        tag_attrs = match.group(3)
        after_tag = match.group(4)
        
        if 'style="' in tag_attrs:
            tag_attrs = re.sub(r'style="([^"]*)"', 
                               lambda m: 'style="' + re.sub(r'(margin|padding)-bottom:[^;!]+(!important)?;?', '', m.group(1)).strip().rstrip(';') + '; margin-bottom: 0 !important; padding-bottom: 0 !important;"', 
                               tag_attrs)
        else:
            tag_attrs = tag_attrs.rstrip('>') + ' style="margin-bottom: 0 !important; padding-bottom: 0 !important;">'
            
        return before_tag + '<' + tag_name + tag_attrs + after_tag

    # Target the last element inside <main> or <body> that is NOT the footer
    # This regex is a bit greedy, let's just do it for sections or divs that might be last
    content = re.sub(r'([\s\S]*?)(<(section|div|header|blockquote)[^>]*>)([\s\S]*?)(?=\s*<footer|\s*</main>|\s*</body>)', 
                     lambda m: m.group(1) + re.sub(r'style="([^"]*)"', 
                                                  lambda m2: 'style="' + re.sub(r'(margin|padding)-bottom:[^;!]+(!important)?;?', '', m2.group(1)).strip().rstrip(';') + '; margin-bottom: 0 !important; padding-bottom: 0 !important;"', 
                                                  m.group(2)) if 'style="' in m.group(2) else m.group(2).rstrip('>') + ' style="margin-bottom: 0 !important; padding-bottom: 0 !important;">' + m.group(4), 
                     content, flags=re.IGNORECASE)

    # Final cleanup of extra semicolons and empty styles
    content = content.replace('; ;', ';').replace(';;', ';').replace('style=" "', '').replace('  ', ' ')
    content = re.sub(r'style="\s*;+\s*"', '', content)

    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)

print("Finished cleaning HTML files.")
