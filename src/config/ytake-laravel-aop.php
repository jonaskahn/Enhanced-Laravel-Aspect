<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * Copyright (c) 2015-2016 Yuuki Takezawa
 *
 */
return [

    'aspect' => [
        /**
         * choose aop library
         * "ray"(Ray.Aop), "none"(for testing)
         */
        'default' => env('ASPECT_DRIVER', 'ray'),

        /**
         * for aspect driver options
         */
        'drivers'     => [
            'ray'  => [
                // string Path to the compiled directory where compiled classes will be stored
                'compile_dir' => storage_path('framework/aop/compile'),
                // aspect kernel cacheable
                'cache' => env('ASPECT_CACHEABLE', false),
                // string Path to the cache file directory where cache classes will be stored
                'cache_dir' => storage_path('framework/aop/cache'),
            ],
            'none' => [
                // for testing driver
                // no use aspect
            ]
        ],
    ],

    'annotation' => [
        /**
         * choose annotation reader
         * 'array'(default), 'file'(file cache), apcu
         */
        'default' => env('ASPECT_ANNOTATION_DRIVER', 'array'),

        'debug' => env('ASPECT_ANNOTATION_DEBUG', false),

        'drivers' => [
            'file' => [
                'cache_dir' => storage_path('framework/annotation'),
            ],
        ],

        'ignores' => [
            // global Ignored Annotations
            'Hears',
            'Get',
            'Post',
            'Put',
            'Patch',
            'Options',
            'Delete',
            'Any',
            'Middleware',
            'Resource',
            'Controller'
        ],
    ],
];
