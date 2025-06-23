<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class ViewTreeCommand extends Command
{
    protected $signature = 'view:tree';
    protected $description = 'Menampilkan struktur folder resources/views hingga 2 level';

    public function handle()
    {
        $baseDir = resource_path('views');
        $rii = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($baseDir, \FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($rii as $file) {
            $depth = substr_count(str_replace($baseDir, '', $file->getPathname()), DIRECTORY_SEPARATOR);
            if ($depth <= 2) {
                $prefix = str_repeat('│   ', $depth);
                $name = $file->isDir() ? '📁 ' . $file->getFilename() : '📄 ' . $file->getFilename();
                $this->line("{$prefix}{$name}");
            }
        }

        return Command::SUCCESS;
    }
}
