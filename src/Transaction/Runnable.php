<?php

declare(strict_types=1);

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
 * Copyright (c) 2015-2020 Yuuki Takezawa
 *
 */

namespace Ytake\LaravelAspect\Transaction;

use Exception;
use Illuminate\Database\DatabaseManager;

/**
 * Interface Runnable
 */
interface Runnable
{
    /**
     * @param DatabaseManager $databaseManager
     * @param string $exceptionName
     * @param callable $invoker
     *
     * @return mixed
     * @throws Exception
     */
    public function __invoke(
        DatabaseManager $databaseManager,
        string          $exceptionName,
        callable        $invoker
    );
}