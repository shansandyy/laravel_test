<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class UpdateProductPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $product;
    public function __construct($product)
    {
        $this->product = $product;
        $this->onQueue('high');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(5);
        // User::insert(
        //     [
        //         'name' => $this->product['name'],
        //         'email' => $this->product['email'],
        //         'password' => bcrypt($this->product['password']),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]
        // );

        // dd($this->product);
        // $this->product->update(['price' => $this->product->price * random_int(2, 5)]);

        User::find($this->product)->update(['password' => 43567]);
    }

    public function failed()
    {
        dd('job filed');
    }
}
