<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve users created in the UserSeeder using their document numbers
        $mainReader = User::where('document_number', 135791113)->first();
        $carlosReader = User::where('document_number', 5544332211)->first();
        $anaReader = User::where('document_number', 9988776655)->first();

        $loans = [];

        // Loans for the Main Reader (if they exist)
        if ($mainReader) {
            $loans[] = [
                'user_id' => $mainReader->id,
                'book_id' => 1, // Assume that the book ID exists
                'status' => 'returned',
                'due_date' => '2026-06-10 12:00:01', // Updated to be after 2026-06-09 12:00:00
                'quantity' => 1,
                'returned_at' => '2026-06-10 12:00:01', // Updated to match new due date
                'is_archived' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $loans[] = [
                'user_id' => $mainReader->id,
                'book_id' => 2,
                'status' => 'approved',
                'due_date' => '2026-06-15 12:00:00', // Updated to be after 2026-06-09 12:00:00
                'quantity' => 1,
                'returned_at' => null,
                'is_archived' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Loans for Carlos Mendoza (New Reader)
        if ($carlosReader) {
            $loans[] = [
                'user_id' => $carlosReader->id,
                'book_id' => 3,
                'status' => 'requested',
                'due_date' => '2026-06-18 12:00:00', // Updated to be after 2026-06-09 12:00:00
                'quantity' => 2,
                'returned_at' => null,
                'is_archived' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Loans for Ana Gómez (New Reader)
        if ($anaReader) {
            $loans[] = [
                'user_id' => $anaReader->id,
                'book_id' => 1,
                'status' => 'rejected',
                'due_date' => '2026-06-17 12:00:00', // Updated to be after 2026-06-09 12:00:00
                'quantity' => 1,
                'returned_at' => null,
                'is_archived' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $loans[] = [
                'user_id' => $anaReader->id,
                'book_id' => 2,
                'status' => 'returned',
                'due_date' => '2026-06-12 12:00:00', // Updated to be after 2026-06-09 12:00:00
                'quantity' => 1,
                'returned_at' => '2026-06-11 12:00:00', // Updated to match new due date
                'is_archived' => true,                // Updated to match new due date
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // Insert the generated loans into the database
        if (!empty($loans)) {
            DB::table('loans')->insert($loans);
        }
    }
}
