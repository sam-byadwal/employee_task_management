<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {

            if (!Schema::hasColumn('tasks', 'title')) {
                $table->string('title')->after('id');
            }

            if (!Schema::hasColumn('tasks', 'description')) {
                $table->text('description')->after('title');
            }

            if (!Schema::hasColumn('tasks', 'assigned_to')) {
                $table->foreignId('assigned_to')
                    ->after('description')
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('tasks', 'priority')) {
                $table->string('priority')->default('medium')->after('assigned_to');
            }

            if (!Schema::hasColumn('tasks', 'status')) {
                $table->string('status')->default('pending')->after('priority');
            }

            if (!Schema::hasColumn('tasks', 'due_date')) {
                // $table->date('due_date')->nullable()->after('status');
                $table->date('due_date')->after('status');

            }
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {

            if (Schema::hasColumn('tasks', 'assigned_to')) {
                $table->dropForeign(['assigned_to']);
            }

            $columns = [
                'title',
                'description',
                'assigned_to',
                'priority',
                'status',
                'due_date',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('tasks', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};