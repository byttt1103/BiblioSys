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
                'loan_date' => '2026-05-10',
                'due_date' => '2026-05-17',
                'quantity' => 1,
                'returned_at' => '2026-05-15',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $loans[] = [
                'user_id' => $mainReader->id,
                'book_id' => 2,
                'status' => 'approved',
                'loan_date' => '2026-06-01',
                'due_date' => '2026-06-08',
                'quantity' => 1,
                'returned_at' => null,
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
                'loan_date' => '2026-06-04',
                'due_date' => '2026-06-11',
                'quantity' => 2,
                'returned_at' => null,
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
                'loan_date' => '2026-05-20',
                'due_date' => '2026-05-27',
                'quantity' => 1,
                'returned_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $loans[] = [
                'user_id' => $anaReader->id,
                'book_id' => 2,
                'status' => 'returned',
                'loan_date' => '2026-05-01',
                'due_date' => '2026-05-08',
                'quantity' => 1,
                'returned_at' => '2026-05-07',
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
