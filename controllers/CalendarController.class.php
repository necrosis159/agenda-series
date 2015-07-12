<?php
   class CalendarController extends baseView {

      //  Affichage le calendrier
      public function show() {

         $calendar = new Calendar();

         $year = null;
         $month = null;

         if($year == null && isset($_GET['year'])) {
            $year = $_GET['year'];
         }
         else if($year == null) {
            $year = date("Y", time());
         }

         if($month == null && isset($_GET['month'])) {
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
                                $dataEpisode = $calendar->_requestData($month, $year);

                                // Création des semaines
                                for($i = 0; $i < $weeksInMonth; $i++) {

                                    //Création des jours
                                    for($j = 1; $j <= 7; $j++){
                                        $content .= $calendar->_showDay($i * 7 + $j, $dataEpisode);
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
