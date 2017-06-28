<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Use the tests\utilties\functions.php make() function to add a record to the database.
    */
   public function create($type, $attribs = [], $table = null)
   {
        $id = $this->haveInDatabase($table ?? $type, $record = make($type, $attribs, false));
        
        $record['id'] = $id;

        return (object) $record;
   }
}
