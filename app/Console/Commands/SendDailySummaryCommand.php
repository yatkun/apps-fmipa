<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TelegramNotificationService;

class SendDailySummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:daily-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily summary of letter status to Telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegramService = new TelegramNotificationService();
        
        $this->info('Sending daily summary to Telegram...');
        
        $result = $telegramService->sendDailySummary();
        
        if ($result) {
            $this->info('✅ Daily summary sent successfully!');
        } else {
            $this->error('❌ Failed to send daily summary.');
        }
        
        return $result ? Command::SUCCESS : Command::FAILURE;
    }
}
