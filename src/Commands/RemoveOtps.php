<?php

namespace TechEd\SimplOtp\Commands;

use Illuminate\Console\Command;
use TechEd\SimplOtp\Models\SimplOtp;

class RemoveOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpl-otp:remove-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired otps';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $otps = SimplOtp::where('valid', 0)->delete();

            $this->info("Found {$otps} expired otps.");
            $this->info($otps ? "Expired tokens deleted" : "No tokens were deleted");
        } catch (\Exception $e) {
            $this->error("Error:: {$e->getMessage()}");
        }

        return 0;
    }
}
