<?php

namespace VojislavD\LaravelMessages\Traits;

trait Migrations
{
    /**
     * @return array<string, string>
     */
    public function getMigrations()
    {
        $existingMigrations = $this->existingMigrations();

        $migrations = [];

        if (! in_array('create_threads_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../../database/migrations/create_threads_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()). '_create_threads_table.php');
        }

        if (! in_array('create_thread_user_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../../database/migrations/create_thread_user_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()+1). '_create_thread_user_table.php');
        }

        if (! in_array('create_messages_table.php', $existingMigrations)) {
            $migrations[__DIR__.'/../../database/migrations/create_messages_table.stub'] = database_path('migrations/'. date('Y_m_d_His', time()+2). '_create_messages_table.php');
        }

        return $migrations;
    }
    
    /**
     * @return array<int, string>
     */
    public function existingMigrations()
    {
        $files = scandir(database_path('migrations'));

        $existingMigrations = [];

        foreach ($files as $file) {
            $existingMigrations[] = substr($file, 18, strlen($file) - 16);
        }
        
        return $existingMigrations;
    }
}