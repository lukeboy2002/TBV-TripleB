<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }

        .h-screen {
            height: 100vh;
        }

        .mx-auto {
            margin: auto;
        }

        .flex {
            display: flex;
        }

        .ml-1 {
            margin-left: 0.25rem; /* 4px */
        }

        .mt-4 {
            margin-top: 1rem; /* 16px */
        }

        .mt-8 {
            margin-top: 2rem; /* 32px */
        }

        .p-4 {
            padding: 1rem; /* 16px */
        }

        .p-10 {
            padding-top: 2.5rem; /* 40px */
        }

        .pt-5 {
            padding-top: 1.25rem; /* 20px */
        }

        .bg-white {
            background-color: rgb(255 255 255);
        }

        .bg-gray-100 {
            background-color: rgb(243 244 246);
        }

        .text-orange-500 {
            color: rgb(249 115 22);
        }

        .text-black {
            color: rgb(0 0 0);
        }

        .max-w-xl {
            max-width: 32rem; /* 512px */
        }

        .rounded-lg {
            border-radius: 0.5rem; /* 8px */
        }

        .text-center {
            text-align: center;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-extrabold {
            font-weight: 800;
        }

        .text-xs {
            font-size: 0.75rem; /* 12px */
            line-height: 1rem; /* 16px */
        }

        .text-sm {
            font-size: 0.875rem; /* 14px */
            line-height: 1.25rem; /* 20px */
        }

        .text-3xl {
            font-size: 1.875rem; /* 30px */
            line-height: 2.25rem; /* 36px */
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        blockquote {
            margin: 1.5em 0 1.5em;
            padding: 0 1em 0 2.5em;
            position:relative;
        }
        blockquote:before
        {
            color: #ccc;
            content: "\201C";
            font-size: 5em;
            position:absolute;
            left:5px;
            top: 0.3em;
            line-height: 0.1em;
        }

        blockquote:after
        {
            color: #ccc;
            content: "\201D";
            font-size: 5em;
            position:absolute;
            right:3px;
            bottom: 0em;
            line-height: 0.1em;
        }

        strong {
            font-weight: bold;
        }

        italic {
            font-style: italic;
        }

        a {
            color: rgb(249 115 22);
            text-decoration: underline;
        }

        p {
            margin: 0;
        }
    </style>
</head>

<body>
<div class="h-screen bg-gray-100 p-10">
    <h1 class="pt-5 text-center text-3xl font-extrabold text-orange-500">Contact with TBV-TripleB</h1>
    <div class="mx-auto max-w-xl rounded-lg bg-white p-4">
        <div class="font-semibold text-black">Hello, <span class="text-orange-500">{{ ucfirst( $mailData['name'] ) }}</span> you got in touch with us</div>
        <div class="mt-4 text-sm">
            <div class="underline">Subject</div>
            <div>{{ ucfirst( $mailData['subject'] ) }}</div>
        </div>
        <div class="mt-4 text-sm">
            <div class="underline">Message</div>
            <div>{!! ucfirst( $mailData['message'] ) !!}</div>
        </div>
        <div class="mt-8 text-sm flex">
            <div>Best Regards:</div>
            <div class="ml-1">TBV-TripleB</div>
        </div>
    </div>
</div>
</body>
</html>
