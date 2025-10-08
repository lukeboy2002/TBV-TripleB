@props(['enableImageUpload' => false])
<div class="flex items-center">
    <div class="flex items-center gap-2 pt-2 flex-wrap">
        <button id="typographyDropdownButton" data-dropdown-toggle="typographyDropdown"
                class="flex items-center justify-center rounded-lg bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-500 hover:bg-gray-200 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-600 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-white dark:focus:ring-gray-600"
                type="button">
            Format
            <svg class="-me-0.5 ms-1.5 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 9-7 7-7-7"/>
            </svg>
        </button>
        <div class="ps-1.5">
            <span class="block w-px h-4 bg-gray-300 dark:bg-gray-600"></span>
        </div>
        <!-- Heading Dropdown -->
        <div id="typographyDropdown" class="z-10 hidden w-72 rounded-sm bg-white p-2 shadow-sm dark:bg-gray-700">
            <ul class="space-y-1 text-sm font-medium" aria-labelledby="typographyDropdownButton">
                <li>
                    <button id="toggleParagraphButton" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Paragraph
                    </button>
                </li>
                <li>
                    <button data-heading-level="1" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 1
                    </button>
                </li>
                <li>
                    <button data-heading-level="2" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 2
                    </button>
                </li>
                <li>
                    <button data-heading-level="3" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 3
                    </button>
                </li>
                <li>
                    <button data-heading-level="4" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 4
                    </button>
                </li>
                <li>
                    <button data-heading-level="5" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 5
                    </button>
                </li>
                <li>
                    <button data-heading-level="6" type="button"
                            class="flex justify-between items-center w-full text-base rounded-sm px-3 py-2 hover:bg-gray-100 text-gray-900 dark:hover:bg-gray-600 dark:text-white">
                        Heading 6
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <button id="toggleBoldButton" data-tooltip-target="tooltip-bold" type="button"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"/>
        </svg>
        <span class="sr-only">Bold</span>
    </button>
    <div id="tooltip-bold" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle bold
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleItalicButton" data-tooltip-target="tooltip-italic" type="button"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18"/>
        </svg>
        <span class="sr-only">Italic</span>
    </button>
    <div id="tooltip-italic" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle italic
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleUnderlineButton" data-tooltip-target="tooltip-underline" type="button"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4"/>
        </svg>
        <span class="sr-only">Underline</span>
    </button>
    <div id="tooltip-underline" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle underline
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div class="px-1">
        <span class="block w-px h-4 bg-gray-300 dark:bg-gray-600"></span>
    </div>

    <button id="toggleListButton" type="button" data-tooltip-target="tooltip-list"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"/>
        </svg>
        <span class="sr-only">Toggle list</span>
    </button>
    <div id="tooltip-list" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle list
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleOrderedListButton" type="button" data-tooltip-target="tooltip-ordered-list"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4"/>
        </svg>
        <span class="sr-only">Toggle ordered list</span>
    </button>
    <div id="tooltip-ordered-list" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle ordered list
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleBlockquoteButton" type="button" data-tooltip-target="tooltip-blockquote-list"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M6 6a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3H5a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2H6Zm9 0a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3h-1a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2h-3Z"
                  clip-rule="evenodd"/>
        </svg>
        <span class="sr-only">Toggle blockquote</span>
    </button>
    <div id="tooltip-blockquote-list" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Toggle blockquote
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div class="px-1">
        <span class="block w-px h-4 bg-gray-300 dark:bg-gray-600"></span>
    </div>

    <button id="toggleLeftAlignButton" type="button" data-tooltip-target="tooltip-left-align"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 6h8m-8 4h12M6 14h8m-8 4h12"/>
        </svg>
        <span class="sr-only">Align left</span>
    </button>
    <div id="tooltip-left-align" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Align left
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleCenterAlignButton" type="button" data-tooltip-target="tooltip-center-align"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 6h8M6 10h12M8 14h8M6 18h12"/>
        </svg>
        <span class="sr-only">Align center</span>
    </button>
    <div id="tooltip-center-align" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Align center
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="toggleRightAlignButton" type="button" data-tooltip-target="tooltip-right-align"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M18 6h-8m8 4H6m12 4h-8m8 4H6"/>
        </svg>
        <span class="sr-only">Align right</span>
    </button>
    <div id="tooltip-right-align" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Align right
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <button id="toggleCodeButton" type="button" data-tooltip-target="tooltip-code"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/>
        </svg>
        <span class="sr-only">Code</span>
    </button>
    <div id="tooltip-code" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Format code
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>


    <div class="px-1">
        <span class="block w-px h-4 bg-gray-300 dark:bg-gray-600"></span>
    </div>

    <button id="toggleLinkButton" data-tooltip-target="tooltip-link" type="button"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
        </svg>
        <span class="sr-only">Link</span>
    </button>
    <div id="tooltip-link" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Add link
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="removeLinkButton" data-tooltip-target="tooltip-remove-link" type="button"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="M13.2 9.8a3.4 3.4 0 0 0-4.8 0L5 13.2A3.4 3.4 0 0 0 9.8 18l.3-.3m-.3-4.5a3.4 3.4 0 0 0 4.8 0L18 9.8A3.4 3.4 0 0 0 13.2 5l-1 1m7.4 14-1.8-1.8m0 0L16 16.4m1.8 1.8 1.8-1.8m-1.8 1.8L16 20"/>
        </svg>
        <span class="sr-only">Remove link</span>
    </button>
    <div id="tooltip-remove-link" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Remove link
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button id="addImageButton" type="button" data-tooltip-target="tooltip-image"
            class="p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1Z"
                  clip-rule="evenodd"/>
            <path fill-rule="evenodd"
                  d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A.999.999 0 0 1 20.5 20H4a2.002 2.002 0 0 1-2-2V6Zm6.892 12 3.833-5.356-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18H8.892Z"
                  clip-rule="evenodd"/>
        </svg>
        <span class="sr-only">Add image</span>
    </button>
    @if($enableImageUpload)
        <input type="file" id="editorImageInput" accept="image/*" class="hidden" />
    @endif
    <div id="tooltip-image" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
        Add image
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>