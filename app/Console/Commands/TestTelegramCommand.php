<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TelegramNotificationService;

class TestTelegramCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Telegram bot connection and send a test message';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegramService = new TelegramNotificationService();
        
        $this->info('Testing Telegram bot connection...');
        
        $result = $telegramService->testConnection();
        
        if ($result) {
            $this->info('✅ Telegram bot connection successful!');
            $this->info('Check your Telegram chat for the test message.');
        } else {
            $this->error('❌ Failed to send Telegram message.');
            $this->error('Please check your bot token and chat ID in .env file.');
        }
        
        return $result ? Command::SUCCESS : Command::FAILURE;
    }
}
