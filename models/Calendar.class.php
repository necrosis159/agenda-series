<?php

   class Calendar extends baseModels {

      // Déclaration des avriables privées
      private $currentYear = 0;
      private $currentMonth = 0;
      private $currentDay = 0;
      private $daysInMonth = 0;
      private $currentDate = null;
      private $naviHref = null;
      private $dayLabels = array("Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim");

      // Constructeur du calendrier
      public function __construct() {
         parent::__construct();
         $this->naviHref = "/calendar/show";
      }

      /********************* Propriétés ********************/

      public function setDayLabels($value){
         $this->dayLabels = $value;
      }

      public function getDayLabels(){
         return $this->dayLabels;
      }

      public function setCurrentYear($value) {
         $this->currentYear = $value;
      }

      public function getCurrentYear() {
         return $this->currentYear ;
      }

      public function setCurrentMonth($value) {
         $this->currentMonth = $value;
      }

      public function getCurrentMonth() {
         return $this->currentMonth;
      }

      public function setCurrentDay($value) {
         $this->currentDay = $value;
      }

      public function getCurrentDay() {
         return $this->currentDay;
      }

      public function setCurrentDate($value){
         $this->currentDate = $value;
      }

      public function getCurrentDate(){
         return $this->currentDate;
      }

      public function setDaysInMonth($value){
         $this->daysInMonth = $value;
      }

      public function getDaysInMonth(){
         return $this->daysInMonth;
      }

      /********************* Fonctions **********************/

      // Création de l'élément <li> du <ul>
      public function _showDay($cellNumber) {

         if($this->currentDay == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)) {

               $this->currentDay = 1;

            }
         }
         if( ($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth) ) {

            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));

            $allEpisode = new Episode();
            $allEpisode->selectDistinct()
                           ->from(array("e" => "episode"), array("episode_number"))
                              ->where('e.episode_air_date', $this->currentDate)
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name"), "se.season_id_serie = s.serie_id");

            $result = $allEpisode->execute();
            // echo "<pre>";
            //    var_dump($result);
            // echo "</pre>";

            // A corriger : Bug lorsque le numéro de l'épisode et de la saison sont les mêmes
            if(array_key_exists(0, $result)) {
               $cellIDTVShow = "";

               for($i = 0; $i < count($result); $i++) {
                     $cellContent = $this->currentDay;
                     $cellIDTVShow .= '<a href="#" title="' . $result[$i]['serie_name'] . " : Saison " . $result[$i]['season_number'] . " - Episode " . $result[$i]['episode_number'] . '"><font color="green">&#9632;</font></a> &nbsp; ';
               }
            }
            else {
               $cellContent = $this->currentDay;
               $cellIDTVShow = null;
            }

            $this->currentDay++;
         }
         else {
            $this->currentDate = null;
            $cellContent = null;
            $cellIDTVShow = null;
         }

         $content = '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) . ($cellContent == null ? 'mask' : '') . '">' . $cellContent
                     . "<br>" . $cellIDTVShow . '</li>';

         return $content;
      }

      // Traduction des raccourci générés par la fonction date de PHP
      function myStrtotime($date_string) {
         return strtr(
            strtolower($date_string),
               array('jan'=>'Janvier',
                     'feb'=>'Février',
                     'mar'=>'Mars',
                     'apr'=>'Avril',
                     'may'=>'Mai',
                     'jun'=>'Juin',
                     'jul'=>'Julliet',
                     'aug'=>'Août',
                     'sep'=>'Septembre',
                     'oct'=>'Octobre',
                     'nov'=>'Novembre',
                     'dec'=>'Décembre'
            )
         );
      }

      // Création de la navigation du calendrier
      public function _createNavi() {

         $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
         $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;

         $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
         $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;
         $dateMonth = date('M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1'));

         return
            '<div class="header">'.
                '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Précédent</a>'.
                    '<span class="title">' . $this->currentYear . ' - ' . $this->myStrtotime($dateMonth) . '</span>'.
                '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Suivant</a>'.
            '</div>';
      }

      // Création des labels
      public function _createLabels(){

        $content = '';

        foreach($this->dayLabels as $index => $label){
            $content .= '<li class="' . ($label == 6 ? 'end title':'start title') . ' title">' . $label . '</li>';
        }

        return $content;
      }

      // Calcul des semaines dans le mois
      public function _weeksInMonth($month = null, $year = null){

         if($year == null)
            $year =  date("Y", time());

         if($month == null)
            $month = date("m", time());

         // Recherche du nombre de jours par rapport au mois
         $daysInMonths = $this->_daysInMonth($month, $year);

         $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

         $monthEndingDay= date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

         $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

         if($monthEndingDay < $monthStartDay) {
            $numOfweeks++;
         }

        return $numOfweeks;
      }

      // Calcul du nombre de jour dans un mois
      public function _daysInMonth($month = null, $year = null){

        if($year == null) {
            $year =  date("Y", time());
        }

        if($month == null) {
            $month = date("m", time());
        }

        return date('t', strtotime($year . '-' . $month . '-01'));
      }
   }

?>
