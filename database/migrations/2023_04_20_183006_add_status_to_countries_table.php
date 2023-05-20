<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('status')->default('inactive');
        });

        // Set status to active for specified countries
        DB::table('countries')->whereIn('name', [
            'Australia',
            'Austria',
            'Belgium',
            'Brazil',
            'Bulgaria',
            'Canada',
            'Croatia',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Estonia',
            'Finland',
            'France',
            'Germany',
            'Gibraltar',
            'Greece',
            'Hong Kong',
            'Hungary',
            'India',
            'Indonesia',
            'Ireland',
            'Italy',
            'Japan',
            'Latvia',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Malaysia',
            'Malta',
            'Mexico',
            'Netherlands',
            'New Zealand',
            'Norway',
            'Poland',
            'Portugal',
            'Romania',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Spain',
            'Sweden',
            'Switzerland',
            'Thailand',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
        ])->update(['status' => 'active']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
