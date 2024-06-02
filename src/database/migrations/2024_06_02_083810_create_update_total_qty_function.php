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
            create function update_total_qty() returns trigger
    language plpgsql
as
$$
DECLARE
    _count INTEGER;
    _product_id INTEGER;
    _category_id integer;
BEGIN
    FOR _count, _product_id, _category_id IN
        SELECT COUNT(*), product_id, category_id FROM orders o
                                                          join products p on p.id = o.product_id
                                                          join categories c on c.id = p.category_id
        where o.buy_date = current_date
        GROUP BY product_id, category_id
        LOOP
            IF EXISTS (SELECT 1 FROM statistics WHERE product_id = _product_id) THEN
                UPDATE statistics SET quantity = _count WHERE product_id = _product_id;
            ELSE
                INSERT INTO statistics (product_id, quantity, category_id, date) VALUES (_product_id, _count, _category_id, current_date);
            END IF;
        END LOOP;
    RETURN NEW;
END;
$$;

        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_total_qty');
    }
};
