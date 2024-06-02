<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::getPdo()->exec('
CREATE TRIGGER inventory_after_insert
    after INSERT
    ON orders
    FOR EACH ROW
EXECUTE FUNCTION update_total_qty();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_after_insert');
    }
};
