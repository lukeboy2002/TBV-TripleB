import {Editor} from 'https://esm.sh/@tiptap/core@2.6.6';
import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.6.6';
import Highlight from 'https://esm.sh/@tiptap/extension-highlight@2.6.6';
import Underline from 'https://esm.sh/@tiptap/extension-underline@2.6.6';
import Link from 'https://esm.sh/@tiptap/extension-link@2.6.6';
import TextAlign from 'https://esm.sh/@tiptap/extension-text-align@2.6.6';
import Image from 'https://esm.sh/@tiptap/extension-image@2.6.6';
import YouTube from 'https://esm.sh/@tiptap/extension-youtube@2.6.6';
import TextStyle from 'https://esm.sh/@tiptap/extension-text-style@2.6.6';
import FontFamily from 'https://esm.sh/@tiptap/extension-font-family@2.6.6';
import {Color} from 'https://esm.sh/@tiptap/extension-color@2.6.6';
import Bold from 'https://esm.sh/@tiptap/extension-bold@2.6.6'; // Import the Bold extension


function initTipTap() {
    const editorRoot = document.getElementById('editor');
    if (!editorRoot) return;
    if (editorRoot.dataset.tiptapInitialized === '1') return;
    editorRoot.dataset.tiptapInitialized = '1';

    const safeOn = (id, event, handler) => {
        const el = document.getElementById(id);
        if (el) el.addEventListener(event, handler);
    };

    const FontSizeTextStyle = TextStyle.extend({
        addAttributes() {
            return {
                ...(this.parent?.() || {}),
                fontSize: {
                    default: null,
                    parseHTML: element => element.style.fontSize,
                    renderHTML: attributes => {
                        if (!attributes.fontSize) {
                            return {};
                        }
                        return {style: `font-size: ${attributes.fontSize}`};
                    },
                },
            };
        },
    });
    const CustomBold = Bold.extend({
        // Override the renderHTML method
        renderHTML({mark, HTMLAttributes}) {
            const {style, ...rest} = HTMLAttributes;

            // Merge existing styles with font-weight
            const newStyle = 'font-weight: bold;' + (style ? ' ' + style : '');

            return ['span', {...rest, style: newStyle.trim()}, 0];
        },
        // Ensure it doesn't exclude other marks
        addOptions() {
            return {
                ...this.parent?.(),
                HTMLAttributes: {},
            };
        },
    });
    // tip tap editor setup
    const hiddenInput = document.getElementById('biography');
    const initial = editorRoot.getAttribute('data-initial') || (hiddenInput ? hiddenInput.value : '');

    const uploadUrl = editorRoot.getAttribute('data-upload-url') || '/editor/uploads/images';

    const editor = new Editor({
        element: document.querySelector('#editor'),
        extensions: [
            StarterKit.configure({
                bold: false,
            }),
            // Include the custom Bold extension
            CustomBold,
            Color,
            FontSizeTextStyle,
            FontFamily,
            Highlight,
            Underline,
            Link.configure({
                openOnClick: false,
                autolink: true,
                defaultProtocol: 'https',
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Image,
            YouTube,
        ],
        content: initial || '',
        editorProps: {
            attributes: {
                class: 'format lg:format-lg dark:format-invert focus:outline-none format-blue max-w-none',
            },
        }
    });

    // sync editor content to hidden input (Livewire)
    if (hiddenInput) {
        // ensure initial sync
        hiddenInput.value = editor.getHTML();
        hiddenInput.dispatchEvent(new Event('input', {bubbles: true}));
    }
    editor.on('update', () => {
        if (hiddenInput) {
            hiddenInput.value = editor.getHTML();
            hiddenInput.dispatchEvent(new Event('input', {bubbles: true}));
        }
    });

    const setBtnActive = (btnId, isActive) => {
        const el = document.getElementById(btnId);
        if (!el) return;
        // Active styles: text-primary and light bg; inactive: text-primary-muted only
        if (isActive) {
            el.classList.add('text-secondary');
            el.classList.add('bg-gray-100');
            el.classList.add('dark:bg-gray-600');
            el.classList.remove('text-primary-muted');
        } else {
            el.classList.remove('text-secondary');
            el.classList.remove('bg-gray-100');
            el.classList.remove('dark:bg-gray-600');
            el.classList.add('text-primary-muted');
        }
    };

    const updateToolbarState = () => {
        // marks
        setBtnActive('toggleBoldButton', editor.isActive('bold'));
        setBtnActive('toggleItalicButton', editor.isActive('italic'));
        setBtnActive('toggleUnderlineButton', editor.isActive('underline'));
        setBtnActive('toggleCodeButton', editor.isActive('code'));
        setBtnActive('toggleLinkButton', editor.isActive('link'));
        // lists / blocks
        setBtnActive('toggleListButton', editor.isActive('bulletList'));
        setBtnActive('toggleOrderedListButton', editor.isActive('orderedList'));
        setBtnActive('toggleBlockquoteButton', editor.isActive('blockquote'));
        // alignment
        setBtnActive('toggleLeftAlignButton', editor.isActive({textAlign: 'left'}));
        setBtnActive('toggleCenterAlignButton', editor.isActive({textAlign: 'center'}));
        setBtnActive('toggleRightAlignButton', editor.isActive({textAlign: 'right'}));
    };

    // update on init and selection changes
    editor.on('selectionUpdate', updateToolbarState);
    editor.on('update', updateToolbarState);
    setTimeout(updateToolbarState, 0);

    // set up custom event listeners for the buttons (guarded)
    safeOn('toggleBoldButton', 'click', () => editor.chain().focus().toggleBold().run());
    safeOn('toggleItalicButton', 'click', () => editor.chain().focus().toggleItalic().run());
    safeOn('toggleUnderlineButton', 'click', () => editor.chain().focus().toggleUnderline().run());
    safeOn('toggleStrikeButton', 'click', () => editor.chain().focus().toggleStrike().run());
    safeOn('toggleHighlightButton', 'click', () => {
        const isHighlighted = editor.isActive('highlight');
        editor.chain().focus().toggleHighlight({
            color: isHighlighted ? undefined : '#ffc078'
        }).run();
    });

    safeOn('toggleLinkButton', 'click', () => {
        const url = window.prompt('Enter image URL:', 'https://flowbite.com');
        if (url) editor.chain().focus().toggleLink({href: url}).run();
    });
    safeOn('removeLinkButton', 'click', () => {
        editor.chain().focus().unsetLink().run();
    });
    safeOn('toggleCodeButton', 'click', () => {
        editor.chain().focus().toggleCode().run();
    });

    safeOn('toggleLeftAlignButton', 'click', () => {
        editor.chain().focus().setTextAlign('left').run();
    });
    safeOn('toggleCenterAlignButton', 'click', () => {
        editor.chain().focus().setTextAlign('center').run();
    });
    safeOn('toggleRightAlignButton', 'click', () => {
        editor.chain().focus().setTextAlign('right').run();
    });
    safeOn('toggleListButton', 'click', () => {
        editor.chain().focus().toggleBulletList().run();
    });
    safeOn('toggleOrderedListButton', 'click', () => {
        editor.chain().focus().toggleOrderedList().run();
    });
    safeOn('toggleBlockquoteButton', 'click', () => {
        editor.chain().focus().toggleBlockquote().run();
    });
    safeOn('toggleHRButton', 'click', () => {
        editor.chain().focus().setHorizontalRule().run();
    });
    // Image upload from client
    const imageInput = document.getElementById('editorImageInput');
    if (imageInput && !imageInput.dataset.listenerAttached) {
        imageInput.addEventListener('change', async (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            try {
                const formData = new FormData();
                formData.append('image', file);
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const res = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: token ? {'X-CSRF-TOKEN': token} : {},
                    body: formData,
                });
                if (!res.ok) throw new Error('Upload failed');
                const data = await res.json();
                if (data?.url) {
                    editor.chain().focus().setImage({src: data.url}).run();
                }
            } catch (err) {
                console.error('Image upload error', err);
                alert('Image upload failed. Please try again.');
            } finally {
                // reset input so selecting the same file again triggers change
                e.target.value = '';
            }
        });
        imageInput.dataset.listenerAttached = '1';
    }
    safeOn('addImageButton', 'click', () => {
        if (imageInput) {
            imageInput.click();
        } else {
            const url = window.prompt('Enter image URL:', 'https://placehold.co/600x400');
            if (url) editor.chain().focus().setImage({src: url}).run();
        }
    });
    safeOn('addVideoButton', 'click', () => {
        const url = window.prompt('Enter YouTube URL:', 'https://www.youtube.com/watch?v=KaLxCiilHns');
        if (url) {
            editor.commands.setYoutubeVideo({
                src: url,
                width: 640,
                height: 480,
            })
        }
    });

    // typography dropdown (guard Flowbite)
    const typographyDropdown = window.FlowbiteInstances?.getInstance?.('Dropdown', 'typographyDropdown');

    safeOn('toggleParagraphButton', 'click', () => {
        editor.chain().focus().setParagraph().run();
        typographyDropdown?.hide?.();
    });

    document.querySelectorAll('[data-heading-level]').forEach((button) => {
        button.addEventListener('click', () => {
            const level = button.getAttribute('data-heading-level');
            editor.chain().focus().toggleHeading({level: parseInt(level)}).run();
            typographyDropdown?.hide?.();
        });
    });

    const textSizeDropdown = window.FlowbiteInstances?.getInstance?.('Dropdown', 'textSizeDropdown');

    // Loop through all elements with the data-text-size attribute
    document.querySelectorAll('[data-text-size]').forEach((button) => {
        button.addEventListener('click', () => {
            const fontSize = button.getAttribute('data-text-size');

            // Apply the selected font size via pixels using the TipTap editor chain
            editor.chain().focus().setMark('textStyle', {fontSize}).run();

            // Hide the dropdown after selection
            textSizeDropdown?.hide?.();
        });
    });

    // Listen for color picker changes
    const colorPicker = document.getElementById('color');
    if (colorPicker) {
        colorPicker.addEventListener('input', (event) => {
            const selectedColor = event.target.value;
            editor.chain().focus().setColor(selectedColor).run();
        });
    }

    document.querySelectorAll('[data-hex-color]').forEach((button) => {
        button.addEventListener('click', () => {
            const selectedColor = button.getAttribute('data-hex-color');
            editor.chain().focus().setColor(selectedColor).run();
        });
    });

    safeOn('reset-color', 'click', () => {
        editor.commands.unsetColor();
    });

    const fontFamilyDropdown = window.FlowbiteInstances?.getInstance?.('Dropdown', 'fontFamilyDropdown');

    // Loop through all elements with the data-font-family attribute
    document.querySelectorAll('[data-font-family]').forEach((button) => {
        button.addEventListener('click', () => {
            const fontFamily = button.getAttribute('data-font-family');
            editor.chain().focus().setFontFamily(fontFamily).run();
            fontFamilyDropdown?.hide?.();
        });
    });
}

// Initialize on page load and when Livewire navigates (if applicable)
window.addEventListener('load', initTipTap);
if (document.readyState !== 'loading') {
    initTipTap();
} else {
    document.addEventListener('DOMContentLoaded', initTipTap);
}
// Livewire v3 navigation event
document.addEventListener('livewire:navigated', initTipTap);
