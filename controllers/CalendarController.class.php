<?php
   class CalendarController extends baseView {

      //  Affichage le calendrier
      public function show() {

         $calendar = new Calendar();

         $allEpisode = new Episode();
         $allEpisode->selectDistinct()
                        ->from(array("e" => "episode"), array("episode_number", "episode_air_date"))
                           ->where('e.episode_air_date', ">=", date("Y-m-d"))
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name, serie_id"), "se.season_id_serie = s.serie_id");
         $result = $allEpisode->execute();

         $year = null;
         $month = null;

         if($year == null && isset($_GET['year']) && $_GET['year'] >= date('Y')) {
            $year = $_GET['year'];
         }
         else if($year == null) {
            $year = date("Y", time());
         }

         if($month == null && isset($_GET['month']) && $_GET['month'] >= date('m')) {
            $month = $_GET['month'];
         }
         else if($month == null) {
            $month = date("m", time());
         }

         $calendar->setCurrentYear($year);
         $calendar->setCurrentMonth($month);
         $calendar->setDaysInMonth($calendar->_daysInMonth($month, $year));

         $content = '<div id="calendar">'.
                        '<div class="box">'.
                        $calendar->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">' . $calendar->_createLabels() . '</ul>';
                                $content .= '<div class="clear"></div>';
                                $content .= '<ul class="dates">';

                                $weeksInMonth = $calendar->_weeksInMonth($month, $year);

                                // Création des mois
                                for($i = 0; $i<$weeksInMonth; $i++) {

                                    //Création des jours
                                    for($j = 1; $j <= 7; $j++){
                                        $content .= $calendar->_showDay($i * 7 + $j, $result);
                                    }
                                }

                                $content .= '</ul>';
                                $content .= '<div class="clear"></div>';

                        $content .= '</div>';

         $content .= '</div>';

         $this->assign("calendar", $content);
         $this->render("calendarShow");
      }
   }
?>
