<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER update_ticket_status_before_update
            BEFORE UPDATE ON event_tickets
            FOR EACH ROW
            BEGIN
                IF NEW.ticketsActual <= 0 THEN
                    SET NEW.ticketsStatus = 'Agotados';
                ELSE
                    SET NEW.ticketsStatus = 'Normal';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS update_ticket_status_before_update
        ");
    }
};
