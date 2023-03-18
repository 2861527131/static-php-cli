<?php
/**
 * Copyright (c) 2022 Yun Dou <dixyes@gmail.com>
 *
 * static-php-cli is licensed under Mulan PSL v2. You can use this
 * software according to the terms and conditions of the
 * Mulan PSL v2. You may obtain a copy of Mulan PSL v2 at:
 *
 * http://license.coscl.org.cn/MulanPSL2
 *
 * THIS SOFTWARE IS PROVIDED ON AN "AS IS" BASIS,
 * WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO NON-INFRINGEMENT,
 * MERCHANTABILITY OR FIT FOR A PARTICULAR PURPOSE.
 *
 * See the Mulan PSL v2 for more details.
 */

declare(strict_types=1);

namespace SPC\builder\macos\library;

class xz extends MacOSLibraryBase
{
    public const NAME = 'xz';

    protected function build()
    {
        [,,$destdir] = SEPARATED_PATH;

        f_passthru(
            $this->builder->set_x . ' && ' .
            "cd {$this->source_dir} && " .
            'autoreconf -i --force && ' .
            "{$this->builder->configure_env} ./configure " .
            '--enable-static ' .
            '--disable-shared ' .
            "--host={$this->builder->gnu_arch}-apple-darwin " .
            '--disable-xz ' .
            '--disable-xzdec ' .
            '--disable-lzmadec ' .
            '--disable-lzmainfo ' .
            '--disable-scripts ' .
            '--disable-doc ' .
            '--with-libiconv ' .
            '--prefix= && ' . // use prefix=/
            'make clean && ' .
            "make -j{$this->builder->concurrency} && " .
            'make install DESTDIR=' . $destdir
        );
    }
}