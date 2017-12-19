<?php
// @codingStandardsIgnoreFile

use Migrations\AbstractMigration;

class ChangeSexToGender extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->changeColumn('sex', 'string', ['limit' => 45])
            ->renameColumn('sex', 'gender')
            ->save();

        $this->execute('UPDATE users SET gender = replace(gender, "m", "male"), gender = replace(gender, "f", "female"), gender = replace(gender, "F", "female")');
    }
}
