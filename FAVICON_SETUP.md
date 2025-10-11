# Favicon Setup Instructions

## Current Status

✅ All view files have been updated to use the school logo as favicon
✅ Favicon links added to:

-   `resources/views/layouts/app.blade.php` (All admin/student pages)
-   `resources/views/welcome.blade.php` (Landing page)
-   `resources/views/auth/admin-login.blade.php` (Admin login)
-   `resources/views/auth/student-login.blade.php` (Student login)

## What You Need to Do

### Add Your School Logo

Place your school logo file in: `public/images/logo.jpg`

**Logo Requirements:**

-   File name: `logo.jpg` (or logo.png)
-   Recommended size: 512x512 pixels (square format)
-   Format: JPG or PNG with transparent background
-   High quality image for best browser tab display

### Alternative: Create Proper Favicon Files (Optional but Recommended)

For better browser compatibility, you can create multiple favicon sizes:

1. **Using an online converter:**

    - Visit: https://favicon.io/favicon-converter/
    - Upload your logo.jpg
    - Download the generated favicon package
    - Extract and place files in `public/` folder:
        - `favicon.ico` (16x16, 32x32)
        - `favicon-16x16.png`
        - `favicon-32x32.png`
        - `apple-touch-icon.png` (180x180)

2. **If you use the favicon package**, update the link tags in all view files from:
    ```html
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}" />
    ```
    To:
    ```html
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('favicon-32x32.png') }}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('favicon-16x16.png') }}"
    />
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{ asset('apple-touch-icon.png') }}"
    />
    ```

## Testing

After adding the logo file:

1. Clear browser cache: `Ctrl + Shift + Delete` or `Ctrl + F5`
2. Visit your site
3. Check the browser tab - you should see your school logo instead of Laravel icon

## Browser Tab Titles

All page titles now follow this format:

-   **Landing Page:** "I.E.T Government High School Management System"
-   **Login Pages:** "[Role] Login - I.E.T Government High School Management System"
-   **Dashboard Pages:** "[Page Name] - I.E.T Government High School Management System"

Examples:

-   ✅ Admin Dashboard - I.E.T Government High School Management System
-   ✅ Student Dashboard - I.E.T Government High School Management System
-   ✅ Classes Management - I.E.T Government High School Management System
-   ✅ Attendance Management - I.E.T Government High School Management System

## Troubleshooting

**Logo not showing?**

1. Verify `public/images/logo.jpg` exists
2. Check file name is exactly `logo.jpg` (case-sensitive on some servers)
3. Clear browser cache completely
4. Try hard refresh: `Ctrl + Shift + R` (Chrome/Firefox) or `Ctrl + F5`
5. Check browser console for 404 errors

**Still showing Laravel icon?**

-   Some browsers cache favicons aggressively
-   Try opening in incognito/private mode
-   Close and reopen the browser completely
-   Clear site data from browser settings

## Files Modified

1. ✅ `resources/views/layouts/app.blade.php`
2. ✅ `resources/views/welcome.blade.php`
3. ✅ `resources/views/auth/admin-login.blade.php`
4. ✅ `resources/views/auth/student-login.blade.php`
