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

namespace Ytake\LaravelAspect\Interceptor;

use Psr\SimpleCache\InvalidArgumentException;
use Ray\Aop\MethodInvocation;
use Ytake\LaravelAspect\Annotation\Cacheable;
use function is_array;
use function is_null;

/**
 * Class CacheableInterceptor
 */
class CacheableInterceptor extends AbstractCache
{
    /**
     * @param MethodInvocation $invocation
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function invoke(MethodInvocation $invocation)
    {
        /** @var Cacheable $annotation */
        $annotation = $invocation->getMethod()->getAnnotation($this->annotation)
            ?? new $this->annotation([]);
        $keys = $this->generateCacheName($annotation->cacheName, $invocation);
        if (!is_array($annotation->key)) {
            $annotation->key = [$annotation->key];
        }
        $keys = $this->detectCacheKeys($invocation, $annotation, $keys);
        // detect use cache driver
        $cache = $this->detectCacheRepository($annotation);
        $key = $this->recursiveImplode($this->join, $keys);
        if ($cache->has($key)) {
            return $cache->get($key);
        }
        $result = $invocation->proceed();
        if (!$annotation->negative) {
            if ($result) {
                $cache->add($key, $result, $annotation->lifetime);
            }

            return $result;
        }
        if (is_null($result)) {
            $cache->add($key, $result, $annotation->lifetime);
        }

        return $result;
    }
}
