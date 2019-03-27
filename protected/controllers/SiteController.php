<?php

class SiteController extends Controller {


    public function actionIndex() {
        $this->pageTitle = "RVDeco: Entreprise générale de bâtiment dans le 92 et toute l'Ile de France";
        $this->render('index');
        Yii::app()->user->setState('save', null);
        Yii::app()->user->setState('elements', null);
        Yii::app()->user->setState('prods', null);
        Yii::app()->user->setState('summacheckbox', null);
    }
    public function actionCalc() {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $calc = Calc::model()->findByPk($id);
        $calcitem = Calcitem::model()->findAll("rod_select_calc = '".$id."'");
        Yii::app()->user->setState('cat', $calc->name_text);
        $i = 0;
        foreach ($calcitem as $value) {
            $active = "";
            if ($i == 0) { $active = 'class = "active"'; } else { $acitve = ""; }
            $tabs = $tabs.'<li role="presentation" '.$active.'><div class="modile-marker"></div>
                <a class = "calccategory" data-id = "'.$value->id.'" href="#calc_category_20" aria-controls="calc_category_20" role="tab" data-toggle="tab" aria-expanded="true">'.$value->name2_text.'</a>
            </li>';
            $i++;
        }

        $results =
            '<ul class="calculator__categories nav nav-tabs" role="tablist">
			'.$tabs.'
		</ul>';


        echo $results;
    }

    public function actionCalcbody() {
        $id = $_POST['id'];
        $calcitem = Calcitem::model()->findByPk($id);
        $kind = Kind::model()->findAll("rod_select_calcitem = '".$id."'");

        foreach ($kind as $value) {
            $info = null;
            if ($value->info_bigtexteditor != null) {
                $info = '<button class="calculator__info-btn dark inline" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="" data-in-anchor="true" data-content="'.strip_tags($value->info_bigtexteditor).'">
				    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
				</button>';
            }
            $body_item = $body_item.'<th><span id = "two">'.$value->name_text.'</span>
				'.$info.'
				<script>
				    $(".calculator__info-btn").popover();  
				</script>
			</th>';
            $body_item_links = $body_item_links.'<th>
				<a href="#" data-id = "'.$value->id.'" class="item-click btn btn-primary btn-xs">+ Choisir</a>
			</th>';
        }

        $body =
            '<div class="row">
			<div id="table-with-options" class="col-xs-12">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="calc_category_15">
						<div class="table-responsive-mode">
							<table class="table">
								<thead>
									<tr>
										<th></th>
										'.$body_item.'
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">
											<span id = "one">'.$calcitem->name_text.'</span>
											<!--<button class="calculator__info-btn dark inline" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="" data-in-anchor="true" data-content="'.$calcitem->info_bigtexteditor.'" data-original-title="'.$calcitem->name_text.'">
											<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
											</button>-->
										</th>
										'.$body_item_links.'
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div id = "calcitem">
				</div>
			</div>
			<div id = "calcresults">
			</div>
		</div>';

        echo $body;
    }


    public function actionCalcitem1() {
        $id = $_POST['id'];
        $critaria = new CDbCriteria();
        $critaria->condition = "kind_select_kind = '".$id."' AND next_select_questionss = '0'";
        $critaria->order = "weight ASC";
        $question = Questionss::model()->find($criteria);

        if ($question->type_select_5 == "choix") {
            $answers = Questionss::model()->findAll("qid_select_questionss = '" .$question->id . "'");
            foreach ($answers as $val) {
                $options = $options . '<option data-id="' . $val->id . '" data-price="' . $val->price_text . '" value="">
						' . $val->name_text . '
					</option>';
            }

            $quest = $quest.'<div class="row  form-group has-feedback" data-action = "'.$c.'" id = "id_'.$c.'" '.$styles.'>
					<div class="col-md-6 col-xs-11">
						<div class="form-group has-feedback">
							<label class="control-label">'.$question->name_text.'</label>
							<select data-action = "'.$c.'" data-finish = "'.$question->finish_checkbox.'" data-price = "'.$question->price_text.'" data-requare = "'.$question->isrequare_checkbox.'" data-field="select" class="sele form-control">
								<option selected disabled>
									Select your option
								</option>
								'.$options.'
							</select>
						</div>
					</div>
				</div>';
            $i++;
        }
        if ($value->info_bigtexteditor != null) {
            $info = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
        }
        echo $quest.'<button data-count = "'.$c.'" id = "id_'.$c.'" type="submit" class="resultat btn btn-success" disabled>
			<!--'.$info.'-->
			Ajouter dans le devis
		</button>';
    }

    public function Getchild($id) {
        /* --- CHECK QID ----*/
        $check_qid = Questionss::model()->findAll("qid_select_questionss = '".$id."'");
        $zapros = "";
        if ($check_qid != null) {
            foreach ($check_qid as $value) {
                $zapros .= "OR next_select_questionss = '".$value->id."'";
            }
        }
        //echo "<pre>";
        // echo $zapros;
        //  echo "</pre>";

        $get_childs = Questionss::model()->findAll("next_select_questionss = '".$id."' ".$zapros."");
        if ($get_childs != null) {
            $last_id = null;
            foreach ($get_childs as $value) {
                $get_array_id = Yii::app()->user->getState('array_id');
                $get_array_id .= ":" . $value->id;
                Yii::app()->user->setState('array_id', $get_array_id);
                $this->Getchild($value->id);

            }
        }

    }

    public function actionCalcitem() {
        Yii::app()->user->setState('array_id', null);
        $id = $_POST['id'];


        $criteria = new CDbCriteria();
        $criteria->condition = "rod_select_kind = '".$id."' AND next_select_questionss = '0'";
        $questions = Questionss::model()->find($criteria);

        $get_array_id = $questions->id;
        Yii::app()->user->setState('array_id', $get_array_id);

        $this->Getchild($questions->id);

        $i = 0;
        $c = 1;
        $s = 1;

        $ex_array_id = explode(":", Yii::app()->user->getState('array_id'));
        //print_r($ex_array_id);
        foreach ($ex_array_id as $go) {
            $value = Questionss::model()->find("id = '".$go."'");
            $options = "";

            if ($c != 1) {
                $styles = 'style = "display:none;"';
            }

            if ($value->type_select_12 == "choix") {
                $answers = Answers::model()->findAll("qid_select_questionss = '" .$value->id . "'");
                foreach ($answers as $val) {
                    $check = Questionss::model()->find("next_select_questionss = '".$val->id."'");
                    $options = $options . '<option data-messagetext = "'.$val->messagetext_text.'" data-finish = "'.$val->finish_checkbox.'" data-action = "'.$check->id.'" data-id="' . $val->id . '" data-price="' . $val->price_text . '" value="'.$val->name_text.'">
						' . $val->name_text . '
					</option>';
                }
                $check2 = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest.'<div data-vid = "'.$value->id.'" data-type = "choix" data-finish = "'.$value->finish_checkbox.'" class="act_'.$s.' row form-group has-feedback my" data-action = "'.$c.'" id = "id_'.$value->id.'" '.$styles.'>
					<div class="col-md-6 col-xs-11">
						<div class="form-group has-feedback">
							<label class="control-label">'.$value->name_text.'</label>
							<select data-cid = "'.$value->id.'" id = "vid_'.$value->id.'" data-action = "'.$check2->id.'" data-ac = "'.$s.'" data-finish = "'.$value->finish_checkbox.'" data-postfix = "'.$value->postfix_text.'" data-mes = "Нет" data-price = "'.$value->price_text.'" data-field="select" class="sel_'.$s.' sele form-control">
								<option selected disabled>
                                    Sélectionner l’option
								</option>
								'.$options.'
							</select>
						</div>
					</div>
				</div>';
                $i++;
                $s++;
            } else if ($value->type_select_12 == "product") {
                $check = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest . '<div data-vid = "'.$value->id.'" data-action = "'.$check->id.'" data-type = "product" data-finish = "'.$value->finish_checkbox.'" class="act_'.$s.' prods form-group has-feedback my" id = "id_'.$value->id.'" '.$styles.'>
                    <div>
                        <div>
                            <label class="control-label">' . $value->name_text . '</label>
                        </div>
                        <a data-action = "' . $c . '" data-id = "' . $value->id . '" class="prod-go btn btn-primary btn-lg" data-fancybox="" data-src="#product-modal-185">
                            <span class="glyphicon glyphicon-modal-window"></span>choix
                        </a>
                        <div class = "choise" style = "margin-top:10px;">Le produit n’a pas ete choisi</div>
                    </div>
                </div>';
                $s++;

            } else if ($value->type_select_12 == "checkbox_list") {
                $check = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest.'
                <div data-vid = "'.$value->id.'" data-type = "checkbox_list" data-finish = "'.$value->finish_checkbox.'" class="act_'.$s.' form-group has-feedback my" data-action = "'.$c.'" id = "id_'.$value->id.'" '.$styles.'>
                    <div>
                        <label class="control-label">'.$value->name_text.'</label>
                    </div>
                    <a data-action = "'.$check->id.'" data-id = "'.$value->id.'" class="checkbox-go btn btn-primary btn-lg" href="javascript:void()">
                        <span class="glyphicon glyphicon-modal-window"></span>choix
                    </a>
                </div>';
            } else if ($value->type_select_12 == "multiplier") {
                $check = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest.'<div data-vid = "'.$value->id.'" data-type = "multiplier" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" class="act_'.$s.' row form-group has-feedback my" data-action = "'.$c.'" id = "id_'.$value->id.'" '.$styles.' data-postfix = "'.$value->postfix_text.'">
                    <div class="col-md-6 col-xs-11">
                        <div class="form-group has-feedback">
                            <label class="control-label">
                                '.$value->name_text.'
                            </label>
                            <div class="input-group">
                                <input data-action = "'.$check->id.'" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" data-field="multiplier" type="number" max="99999" min="1" class="cinput form-control">
                            </div>
                        </div>
                    </div>
                </div>';
                $s++;
            } else if ($value->type_select_12 == "square") {
                $check = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest.'<div data-vid = "'.$value->id.'" data-type = "square" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" class="act_'.$s.' row form-group has-feedback my" data-action = "'.$c.'" id = "id_'.$value->id.'" '.$styles.' data-postfix = "'.$value->postfix_text.'">
                    <div class="col-md-6 col-xs-11">
                        <div class="form-group has-feedback">
                            <label class="control-label">
                                '.$value->name_text.'
                            </label>
                            <div class="input-group">
                                <input data-action = "'.$check->id.'" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" data-field="square" type="number" max="99999" min="1" class="cinput form-control">
                            </div>
                        </div>
                    </div>
                </div>';
                $s++;
            } else if ($value->type_select_12 == "counter") {
                $check = Questionss::model()->find("next_select_questionss = '".$value->id."'");
                $quest = $quest.'<div data-vid = "'.$value->id.'" data-cat = "" data-type = "counter" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" class="act_'.$s.' row form-group has-feedback my" data-action = "'.$check->id.'" id = "id_'.$value->id.'" '.$styles.' data-postfix = "'.$value->postfix_text.'">
                    <div class="col-md-6 col-xs-11">
                        <div class="form-group has-feedback">
                            <label class="control-label">
                                '.$value->name_text.'
                            </label>
                            <div class="input-group">
                                <input data-action = "'.$check->id.'" data-finish = "'.$value->finish_checkbox.'" data-price = "'.$value->price_text.'" data-field="counter" type="number" max="99999" min="1" class="cinput form-control" >
                            </div>
                        </div>
                    </div>
                </div>';
                $s++;
            }
            $c++;
        }

        echo $quest.'<button data-count = "'.$s.'" id = "id_'.$c.'" type="submit" class="resultat btn btn-success" disabled>
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			Ajouter dans le devis
		</button>';
    }

    public function actionCalccheckbox() {
        $id = $_POST['id'];
        $ans = Questionss::model()->find("id = '".$id."'");
        $answers = Questionss::model()->findAll("qid_select_questionss = '" .$id . "'");
        $quest = $quest.'<h3 class="control-label">'.$ans->name_text.'</h3>';
        foreach ($answers as $value) {
            $quest = $quest . '
            <div class="checkbox checkbox_in-table" style = "border: 1px solid rgba(128, 128, 128, 0.31);">
                <label class="block">
                    <input type="checkbox" data-title = "'.$value->messagetext_text.'" data-rod = "'.$id.'" data-id="'.$value->id.'" data-price="'.$value->price_text.'" value="'.$value->price_text.'"> '.$value->name_text.'
                </label>
            </div>';
        }
        $quest = $quest.'<div data-id = "'.$id.'" class="valide btn btn-success" style="padding: 10px 20px; text-transform: uppercase;">Valide</div>';
        echo $quest;
    }

    public function actionCalcresults() {
        $rand = time().rand(1, 1000);
        //$raschet = file_get_contents("zapis");
        $mass = $_POST['my_arr'];
        $count = count($mass);

        $elements = array();
        $ait = array();
        $ob_itog = 0;
        $number = 1;
        $stop = 0;

        foreach($mass as $value) {
            $a = explode("|", $value);
            if (in_array("square", $a) or in_array("counter", $a) or in_array("multiplier", $a) or in_array("product", $a) or in_array("checkbox_list", $a)) {
                $stop = 1;
            }
        }

        for ($i = 0; $i <= $count; $i++) {
            $arr = explode("|", $mass[$i]);

            if ($arr[0] == "choix") {
                array_push($elements, $arr[3]);
                if ($stop == 0 or $arr[4] == 1) {
                    $message = Questionss::model()->find("id = '".$arr[6]."'");
                    preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                    $complete_message = $message->message_bigtexteditor;
                    foreach ($ma[0] as $value) {
                        $put = Yii::app()->user->getState('elements');
                        $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                    }

                    $tbody = $tbody.'<tbody>               
						<tr>
							<td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
							<td><span id="two">
								'.Yii::app()->user->getState('cat').'</span>
							</td>
							<td><span class="details-two" id="two">
								<div class="calculator__results__message_'.$i.'">
									'.$complete_message.'
								</div></span>
							</td>
							<td class="text-center"><span id="two">
								<span class="rudik_count">1</span> <span class="rudik_mer">шт.</span></span>
							</td>
							<td><span id="two">
								<nobr><span class="rudik_price">'.$arr[3].'</span> €</nobr></span>
							</td>
							<td><span id="two">
								<nobr><b class="rudik_total">'.$arr[3].'</b> <b>€</b></nobr></span>
							</td>
							<td class="text-right skrit"><span id="two">
								<div class="btn-group" role="group" aria-label="...">
									<a data-id = "'.$rand.'" href="#" class="remove btn btn-default">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</div></span>
							</td>
						</tr>
					</tbody>';
                    $ob_itog = $ob_itog + $arr[3];
                    $number++;
                }

            } else if ($arr[0] == "square") {
                $vr = 0;
                $starif = 0;
                foreach ($elements as $value) {
                    $vr = $vr + $value * $arr[3];
                    $starif = $starif + $value;
                }
                $tarif = $arr[3];
                $it = $vr;
                $elements = array();
                array_push($ait, $vr);

                $message = Questionss::model()->find("id = '".$arr[6]."'");
                preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                $complete_message = $message->message_bigtexteditor;
                foreach ($ma[0] as $value) {
                    $put = Yii::app()->user->getState('elements');
                    $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                }

                $tbody = $tbody.'<tbody>               
                    <tr>
                        <td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
                        <td><span id="two">
                            '.Yii::app()->user->getState('cat').'</span>
                        </td>
                        <td><span class="details-two" id="two">
                            <div class="calculator__results__message_'.$i.'">
                                '.$complete_message.' 
                            </div></span>
                        </td>
                        <td class="text-center"><span id="two">
                            <span class="rudik_count">'.$arr[3].'</span> <span class="rudik_mer">'.$arr[2].'</span></span>
                        </td>
                        <td><span id="two">
                            <nobr><span class="rudik_price">'.$starif.'</span> €</nobr></span>
                        </td>
                        <td><span id="two">
                            <nobr><b class="rudik_total">'.$it.'</b> <b>€</b></nobr></span>
                        </td>
                        <td class="text-right skrit"><span id="two">
                            <div class="btn-group" role="group" aria-label="...">
                                <a data-id = "'.$rand.'" href="#" class="remove btn btn-default">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                            </div></span>
                        </td>
                    </tr>
                </tbody>';
                $ob_itog = $ob_itog + $vr;
                $number++;

            } else if ($arr[0] == "multiplier") {
                $asd = count($elements);
                $tarif = $elements[$asd];
                $it = $elements[$asd] * $arr[3];
                //array_push($ait,$elements[$asd] * $arr[3]);
                //$elements = array();
                $message = Questionss::model()->find("id = '".$arr[6]."'");
                preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                $complete_message = $message->message_bigtexteditor;
                foreach ($ma[0] as $value) {
                    $put = Yii::app()->user->getState('elements');
                    $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                }

                $vr = 0;
                $mtarif = 0;
                foreach ($elements as $value) {
                    $vr = $vr + $value;
                    $mtarif = $mtarif + $value;
                }
                $vr = $vr * $arr[3];

                $tbody = $tbody.'<tbody>
                    <tr>
                        <td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
                        <td><span id="two">
                            '.Yii::app()->user->getState('cat').'</span>
                        </td>
                        <td><span class="details-two" id="two">
                            <div class="calculator__results__message_'.$i.'">
                                '.$complete_message.'
                            </div></span>
                        </td>
                        <td class="text-center"><span id="two">
                            <span class="rudik_count">'.$arr[3].'</span> <span class="rudik_mer">'.$arr[2].'</span></span>
                        </td>
                        <td><span id="two">
                            <nobr><span class="rudik_price">'.$mtarif.'</span> €</nobr></span>
                        </td>
                        <td><span id="two">
                            <nobr><b class="rudik_total">'.$vr.'</b> <b>€</b></nobr></span>
                        </td>
                        <td class=" text-right skrit"><span id="two">
                            <div class="btn-group" role="group" aria-label="...">
                                <a data-id = "'.$rand.'" href="#" class="remove btn btn-default">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                            </div></span>
                        </td>
                    </tr>

                </tbody>';
                $ob_itog = $ob_itog + $it;
                $number++;

            } else if ($arr[0] == "counter") {
                $it = $arr[3]*$arr[5];
                array_push($ait, $arr[3]*$arr[5]);
                $message = Questionss::model()->find("id = '".$arr[6]."'");
                preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                $complete_message = $message->message_bigtexteditor;
                foreach ($ma[0] as $value) {
                    $put = Yii::app()->user->getState('elements');
                    $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                }

                $tbody = $tbody.'<tbody>
                    <tr>
                        <td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
                        <td><span id="two">
                            '.Yii::app()->user->getState('cat').'
                        </td></span>
                        <td><span class="details-two" id="two">
                            <div class="calculator__results__message_'.$i.'">
                                '.$complete_message.'
                            </div></span>
                        </td>
                       <td class="text-center"><span id="two">
                            <span class="rudik_count">'.$arr[3].'</span> <span class="rudik_mer">'.$arr[2].'</span></span>
                        </td>
                        <td><span id="two">
                            <nobr><span class="rudik_price">'.$tarif.'</span> €</nobr></span>
                        </td>
                        <td><span id="two">
                            <nobr><b class="rudik_total">'.$it.'</b> <b>€</b></nobr></span>
                        </td>
                        <td class="text-right skrit"><span id="two">
                            <div class="btn-group" role="group" aria-label="...">
                                <a data-id = "'.$rand.'" href="#" class="remove btn btn-default">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                            </div></span>
                        </td>
                    </tr>

                </tbody>';
                $ob_itog = $ob_itog + $it;
                $number++;

            } else if ($arr[0] == "product") {
                $get_cena = Yii::app()->user->getState('prods');
                if ($arr[4] == 1 OR count($mass) < 2) {
                    $message = Questionss::model()->find("id = '".$arr[6]."'");
                    preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                    $complete_message = $message->message_bigtexteditor;
                    foreach ($ma[0] as $value) {
                        $put = Yii::app()->user->getState('elements');
                        $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                    }



                    $product = Products::model()->find("id = '".$get_cena[$arr[6]]."'");

                    $tbody = $tbody.'<tbody>
						<tr>
							<td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
							<td><span id="two">
							'.Yii::app()->user->getState('cat').'</span>
							</td>
							<td><span class="details-two" id="two">
								<div class="calculator__results__message_'.$i.'">
									'.$complete_message.'
								</div></span>
							</td>
						   <td class="text-center"><span id="two">
								<span class="rudik_count">1</span></span>
							</td>
							<td><span id="two">
								<nobr><span class="rudik_price">'.$product->cena_text.'</span> €</nobr></span>
							</td>
							<td><span id="two">
								<nobr><b class="rudik_total">'.$product->cena_text.'</b> <b>€</b></nobr></span>
							</td>
							<td class="text-right skrit"><span id="two">
								<div class="btn-group" role="group" aria-label="...">
									<a href="#" data-id = "'.$rand.'" class="remove btn btn-default">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</div></span>
							</td>
						</tr>
					</tbody>';
                    $number++;
                    $elements = array();
                } else {
                    $product = Products::model()->find("id = '".$get_cena[$arr[6]]."'");
                    array_push($elements, $product->cena_text);
                }
            } else if ($arr[0] == "checkbox_list") {
                $sum_array = Yii::app()->user->getState('summacheckbox');
                if ($stop == 0 OR $arr[2] == "1" OR count($mass) < 2) {

                    //$new_ex = explode("_", $arr[1]);

                    $message = Questionss::model()->find("id = '".$arr[3]."'");
                    preg_match_all('/[0-9]+/', $message->message_bigtexteditor, $ma);
                    $complete_message = $message->message_bigtexteditor;
                    foreach ($ma[0] as $value) {
                        $put = Yii::app()->user->getState('elements');
                        $complete_message = str_replace("[".$value."]", $put[$value], $complete_message);
                    }

                    $ob_itog = $ob_itog + $sum_array[$arr[3]];
                    $tbody = $tbody.'<tbody>
						<tr>
							<td class="text-center numbr" scope="row"><span id="two">'.$number.'</span></td>
							<td><span id="two">
								'.Yii::app()->user->getState('cat').'</span>
							</td>
							<td><span class="details-two" id="two">
								<div class="calculator__results__message_'.$i.'">
									'.$complete_message.'
								</div></span>
							</td>
						   <td class="text-center"><span id="two">
								<span class="rudik_count">1</span></span>
							</td>
							<td><span id="two">
								<nobr><span class="rudik_price">'.$sum_array[$arr[3]].'</span> €</nobr></span>
							</td>
							<td><span id="two">
								<nobr><b class="rudik_total">'.$sum_array[$arr[3]].'</b> <b>€</b></nobr></span>
							</td>
							<td class="text-right skrit"><span id="two">
								<div class="btn-group" role="group" aria-label="...">
									<a href="#" data-id = "'.$rand.'" class="remove btn btn-default">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</div></span>
							</td>
						</tr>
					</tbody>';
                    $number++;
                    $elements = array();
                } else {
                    array_push($elements, $sum_array[$arr[3]]);
                }
            }
        }

        //print_r($ait);
        //echo '<pre>';
        //print_r($mass);
        //echo '</pre>';


        //echo '<pre>';
        //print_r($elements);
        //echo '</pre>';

        //echo $good;
        //echo "<br/>".$type.$price."|".$itog_square;

        $proc = $ob_itog*10/100;
        $ooo = round($proc+$ob_itog, 2);
        $arrsave = Yii::app()->user->getState('save');
        if ($arrsave[Yii::app()->user->getState('cat')] == null) {
            $tr = '<td class="active" colspan="7">
                    <div class="table-border__result"></div>
							</td>
							'.$tbody;
        } else {
            $tr = $tbody;
        }

        if (Yii::app()->user->getState('save') == null) {
            $arrsave = array();
        }

        if (count($arrsave) == 0) {
            $arrsave[Yii::app()->user->getState('cat')] .= $tr;
        } else {
            if (!in_array($tr, $arrsave)) {
                $arrsave[Yii::app()->user->getState('cat')] .= $tr;
            }
        }

        foreach ($arrsave as $key => $valu) {
            $ares .= $valu;
        }

        Yii::app()->user->setState('save', $arrsave);


        $result = '<div class="col-xs-12">
			<div class="calculator__results">
				<h2>Devis travaux</h2>
				<hr>
				<div class="table-responsive-mode" id = "pdf">
					<table class="table table-hover" id="calculator_result">
						<thead>
							<tr>
								<th class="text-center"><span id="two">#</span></th>
								<th><span id="two">Descriptif de travaux </span></th>
								<th><span id="two" class="details-two">Details</span></th>
								<th><span id="two">Quantité</span></th>
								<th><span id="two">Tarif</span></th>
								<th><span id="two">Total</span></th>
								<th class = "skrit"><span id="two"></span></th>
							</tr>
						</thead>
						'.$ares.'
						 <tr>
                            <td  colspan="7" class="ugly-motherfuker">
                                <div class="wrap">
                                    <div class="text-right">
                                        Total HT<br>
                                        TVA 10%<br/>
                                        Total TTC
                                    </div>
                                    <div class="prises-total-my">
                                        <nobr><span class="rudik_o_total">'.$ob_itog.'</span> €</nobr>
                                        <br>
                                        <nobr><span class="rudik_o_proc">'.$proc.' €</span></nobr>
                                        <br>
                                        <nobr><span class="rudik_o_result">'.$ooo.'</span> €</nobr>
                                    </div>
                                    <div class="text-right skrit">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="#" class="remove-all btn btn-danger">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="modile-result" class="calculator__results__action">
                                    <div class="calculator__results__action__item c_save">
                                        <a href="/pdf.php" class="go-pdf btn btn-success btn-lg"><span class="icon download-icon"></span>Charger le devis</a>
                                    </div>
                                    <div class="calculator__results__action__item c_send text-right">
                                        <a data-fancybox="" data-src="#calc_save" href="#calc_save" class="btn btn-success btn-lg"><span class="arrow-up icon"></span> Envoyez nous le devis</a>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
					</table>
				</div>
				<div class="calculator__results__action">
					<div class="calculator__results__action__item c_save">
						<a href="/pdf.php" class="go-pdf btn btn-success btn-lg"><span class="icon download-icon"></span>Charger le devis</a>
					</div>
					<div class="calculator__results__action__item c_send text-right">
						<a data-fancybox="" data-src="#calc_save" href="#calc_save" class="btn btn-success btn-lg"><span class="arrow-up icon"></span> Envoyez nous le devis</a>
					</div>
					
				</div>
				<div class="hidden">
					<div id="calc_save">
						<form method="post" enctype="multipart/form-data" action="javascript:void(0);" id="calc_save_form">
							<h3>Envoyez nous le devis</h3>
							<div class="form-group has-feedback">
								<label class="control-label" for="title">Votre nom</label>
								<input id = "nname" value="" type="text" name="user[name]" class="form-control" id="title" placeholder="Votre nom">
							</div>
							<div class="form-group has-feedback">
								<label class="control-label" for="title">Votre numéro de telephone</label>
								<input id = "nphone" value="" type="text" name="user[phone]" class="form-control" id="title" placeholder="Votre numéro de telephone">
							</div>
							<div class="form-group has-feedback">
								<label class="control-label" for="title">Votre e-mail</label>
								<input id = "nemail" value="" type="email" name="user[email]" class="form-control" id="title" placeholder="Votre e-mail">
							</div>
							<button type="submit" id = "sends" class="send-smeta btn btn-default">Envoyez nous le devis</button>
						</form>
						<script>
					$("#calc_save").on("click", "#sends", function () {
						var smeta = $("#pdf").html();
						var email = $("#nemail").val();
                        $.ajax({
                            type: "POST",
                            url: "/site/gopdf/",
                            data:{smeta:smeta, email:email},
                            success: function(data) {
                                $(location).attr(\'href\', \'/mailpdf.php\');
                            },
                        });
                        return false;
					});
					</script>
					</div>
				</div>
                <div id="any-question-modile">
                    <h3>Остались вопросы?<br>закажи бесплатную консультацию <br>прямо сейчас!</h3>
                    <form action="#" class="form labeled-form">
                        <label for="name">your name</label>
                        <input type="text" name="name" placeholder="your name">
                        <label for="phone">your name</label>
                        <input type="text" name="phone" placeholder="phone number">
                        <input id="order-consalt" type="submit" value="заказать">
                    </form>
                </div>
			</div>                      
		</div>';
        Yii::app()->user->setState('summacheckbox', null);
        echo $result;

        //echo "<pre>";
        //print_r(Yii::app()->user->getState('save'));
        //echo "</pre>";
    }

    public function actionCalcproducts() {
        $id = $_POST['id'];
        $quest = Questionss::model()->find("id = '".$id."'");
        $arr = explode(":", $quest->products_text);
        if ($arr != null) {
            foreach ($arr as $value1) {
                $value = Products::model()->find("id = '".$value1."'");
                $img = json_decode($value->image_image, true);
                $kv = "'";
                $imagesss = null;
                $images = json_decode($value->images_pimages, true);
                foreach ($images as $key => $im) {
                    $imagesss .= '<a style="float:left; padding:0;" class="widget-gallery__item_'.$value->id.'" data-fancybox="gallery_'.$value->id.'" href="https://admin.devis-travaux-online.fr/upload/Products/full/'.$im.'"><img style = "height:60px;" class="resposive" src="https://admin.devis-travaux-online.fr/upload/Products/tm/'.$im.'"></a>';
                }
                $res = $res . '
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="thumbnail">
                            <a href="https://admin.devis-travaux-online.fr/upload/Products/full/'.$img[0].'" class="widget-gallery__item_'.$value->id.'" data-fancybox="gallery_'.$value->id.'">
                                <img style = "border-bottom: 1px solid #6969698c;" height = "200" src="https://admin.devis-travaux-online.fr/upload/Products/tm/'.$img[0].'">
                            </a>
                            <div class="caption">
							<div style = "overflow:hidden; display:block;">'.$imagesss.'</div>
                                <a data-id = "'.$value->id.'" href = "#" class = "prod-info"><h4>'.$value->title_text.' 
                                </h4></a>
								<h4><span class="label label-info">'.$value->cena_text.'€</span></h4>
            
                                
								<!--<a target = "_blank" href = "/products/show/id/'.$value->id.'">Подробнее о продукте</a>-->
                                    <button data-title = "'.$value->title_text.'" data-fancybox-close="" onclick = "javascript:ProdChoise('.$kv.$value->title_text.$kv.', '.$kv.$value->cena_text.$kv.', '.$value->id.');" type="button" data-set-select="185" data-set-option="247" data-fancybox-close="" class="pclick btn btn-default" role="button">choix</button>
                                </p>
                            </div>
                        </div>
                    </div>';
            }
            $res = '<button class="fancybox-close-small" title="Close"></button>
                <div class="container">
                    <h2>'.$quest->name_text.'</h2>'.$res.'</div>';
            echo $res;
        }
    }

    public function actionZapis() {
        $type = $_POST['type'];
        $label = $_POST['label'];
        $text = $_POST['text'];
        $price = $_POST['price'];
        $finish = $_POST['finish'];
        $dopprice = $_POST['dopprice'];

        $zapis = file_get_contents("zapis");
        if ($zapis == null) {
            $zapis = $type."|".$label."|".$text."|".$price."|".$finish."|".$dopprice;
        } else {
            $zapis = $zapis."\r\n".$type."|".$label."|".$text."|".$price."|".$finish."|".$dopprice;
        }
        file_put_contents("zapis", $zapis);
    }

    public function actionSend() {
        $obsh = Obsh::model()->find("id = '1'");
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "ukiuki.zakaz@gmail.com";
        $mail->Password = "Maint112233";
        $mail->setFrom('info@rvdeco.com', 'rvdeco.com');
        $mail->addAddress($_POST['email'], $_POST['email']);
        $mail->isHTML(true);

        $mail->Subject = 'devis-travaux-online.fr';
        $mail->Body    = "<html>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
				</head>
				<body>
					".$obsh->smeta_bigtexteditor."
				</body>
				</html>";
        $mail->AltBody = 'This is a plain-text message body';

        if (!$mail->send()) {
            exit("Mailer Error: " . $mail->ErrorInfo);
        }
    }

    public function actionGettext() {
        $id = $_POST['id'];
        $model = Questionss::model()->find("id = '".$id."'");
        echo $model->messagetext_text;
    }

    public function actionGopdf() {
        $criteria = new CDbCriteria();
        $criteria->limit = 1;
        $criteria->order = "id DESC";
        $number = Smeta::model()->find($criteria);
        $num = $number->id+1;

        $model = new Smeta();
        $model->nomer_text = $num;
        $model->file_file = $num.".pdf";
        $model->save();

		$obsh = Obsh::model()->find("id = '1'");
		$_SESSION["txt"] = $obsh['smeta_bigtexteditor'];
        $_SESSION["email"] = $_POST['email'];
        $_SESSION["pdf_name"] = $num;
        $_SESSION["pdf"] = $_POST['smeta'];

    }

    public function actionDelete() {
        $id = $_POST['id'];
        $arrsave = Yii::app()->user->getState('save');
        $arrsave[$id] = null;
        Yii::app()->user->setState('save', $arrsave);
        print_r(Yii::app()->user->getState('save'));
    }

    public function actionAlldelete() {
        Yii::app()->user->setState('save', null);
    }

    public function actionForm() {
        echo '<div id = "resform"><form enctype="multipart/form-data" class="form-vertical" id="feedback-form" action="" method="post">			<div class="form-group has-feedback">
				<label class="control-label" for="title">Votre nom</label>
				<input class="form-control" name="Feedback[name_text]" id="rname" type="text" maxlength="255">				<span class="text-small text-muted" id="Feedback_name_text_em_" style="display: none"></span>			</div>
			<div class="form-group has-feedback">
				<label class="control-label" for="email">Votre e-mail</label>
				<input class="form-control" name="Feedback[email_text]" id="rnamet" type="email" maxlength="255">
				<span class="text-small text-muted" id="Feedback_email_text_em_" style="display: none"></span>			</div>
			<div class="form-group has-feedback">
				<label class="control-label" for="message">Votre message</label>
				<textarea class="form-control" name="Feedback[message_bigtext]" id="rmessage"></textarea>				<span class="text-small text-muted" id="Feedback_message_bigtext_em_" style="display: none"></span>			</div>
			<button type="submit" data-type = "popup" class="send-contact btn btn-default">Envoyer</button>
		</form></div>';
    }

    public function actionSaves() {
        Yii::app()->user->setState('save', $_POST['save']);
    }



    public function actionElement() {
        $id = $_POST['id'];
        $option_id = $_POST['option_id'];
        $session = $_POST['session'];
        if ($id != null) {
            $array = Yii::app()->user->getState('elements');
            if ($_POST['type'] != "prod") {
                $model = Questionss::model()->find("id = '" . $option_id . "'");
                $summacheckbox = Yii::app()->user->getState('summacheckbox');
                if ($model->messagetext_text != null) {
                    if ($array[$id] == null OR $session != Yii::app()->user->getState('session')) {
                        $array[$id] = $model->messagetext_text;
                    } else {
                        $array[$id] .= ", " . $model->messagetext_text;
                    }
                } else {
                    if ($array[$id] == null OR $session != Yii::app()->user->getState('session')) {
                        $array[$id] = $model->name_text;
                    } else {
                        $array[$id] .= ", " . $model->name_text;
                    }
                }

                if ($summacheckbox[$id] == null OR $session != Yii::app()->user->getState('session')) {
                    $summacheckbox[$id] = $model->price_text;
                } else {
                    $summacheckbox[$id] = $summacheckbox[$id] + $model->price_text;
                }
                Yii::app()->user->setState('summacheckbox', $summacheckbox);
                Yii::app()->user->setState('session', $session);
            } else {
                $model = Products::model()->find("id = '" . $option_id . "'");
                $array[$id] = $model->title_text;
            }

            Yii::app()->user->setState('elements', $array);
            print_r(Yii::app()->user->getState('summacheckbox'));
        }
    }

    public function actionProds() {
        $id = $_POST['id'];
        $prodselect = $_POST['prodselect'];
        if ($id != null) {
            $prods = Yii::app()->user->getState('prods');
            $prods[$prodselect] = $id;
            Yii::app()->user->setState('prods', $prods);
            echo "--------";
            print_r(Yii::app()->user->getState('prods'));
        }
    }
	
	public function actionProdinfo() {
		$id = $_POST['id'];
		$model = Products::model()->findByPk($id);
		$this->pageTitle = $model->title_text;
		$this->renderPartial('/products/show', array('model' => $model));		
	}
}
?>