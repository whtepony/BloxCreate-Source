<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

return [
    // Renderer
    'DB_HOST'         => 'localhost',
    'DB_NAME'         => 'main_website',
    'DB_USER'         => 'admin',
    'DB_PASS'         => '05f2823cffe842dbf85307a393c843cf4fbd265615bbd3dc',
    'SERIOUS_KEY'     => 'key',
    'ALLOWED_TYPES'   => ['item', 'user', 'preview'],
    'FOCUS_ITEMS'     => true,
    'FACES_PNG'       => false,

    // Site
    'SITE_NAME' => 'Roblox Clone',

    // Directories
    'DIRECTORIES' => [
        'ROOT'       => '/var/www/storage',
        'UPLOADS'    => '/var/www/storage/uploads',
        'THUMBNAILS' => '/var/www/storage/thumbnails'
    ],

    // Colors
    'ITEM_BODY_COLOR' => '#d3d3d3',

    // Avatar
    'AVATARS' => [
        'DEFAULT' => '/var/www/bloxcity/render/blend/nobevels_avatar.blend',
        'TOOL'  => '/var/www/bloxcity/render/blend/nobevels_avatar_gadget.blend',
    ],

    // Headshot Camera
    'HEADSHOT_CAMERA' => [
        'LOCATION' => [
            'X' => '-0.61512',
            'Y' => '-2.12488',
            'Z' => '2.62124'
        ],

        'ROTATION' => [
            'X' => '83.919',
            'Y' => '-0.351',
            'Z' => '-20.147'
        ]
    ],

    // Image Sizes
    'IMAGE_SIZES' => [
        'USER_AVATAR'   => 512,
        'USER_HEADSHOT' => 256,
        'ITEM'          => 375
    ]
];
