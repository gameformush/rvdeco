<?
	class Functions 
	{
		public static function putActivity($parent_info, $user_id, $type, $action, $title) {
			$model = new Activity;
			$model->parent_info = $parent_info;
			$model->user_id = $user_id;
			$model->type = $type; 
			$model->action = $action;
			if ($type == "tasks") {
				if ($action == 5) {
					$subject = "Просрочена задача в Maint Control";
					$message = 'Просрочена задача <a href = "http://control.maint.kz/tasks/">'.$title.'</a>';
					$color = "bg-danger-400";
				} else if ($action == 6) {
					$subject = "Новая задача в Maint Control";
					$message = 'Новая задача <a href = "http://control.maint.kz/tasks/">'.$title.'</a> от <a href = "#">'.$parent_info.'</a>';
					$color = "bg-orange-400";
				} else if ($action == 7) {
					$subject = "Согласуйте задачу в Maint Control";
					$message = 'Согласуйте задачу <a href = "http://control.maint.kz/alltasks/check">'.$title.'</a> от: <a href = "#">'.$parent_info.'</a>';
					$color = "bg-primary-400";
				} else if ($action == 9) {
					$subject = "Задача возвращена в Maint Control";
					$message = 'Задача возвращена <a href = "http://control.maint.kz/tasks/">'.$title.'</a> вернул: <a href = "#">'.$parent_info.'</a>';
					$color = "bg-warning-400";
				} else if ($action == 10) {
					$subject = "Задача согласована в Maint Control";
					$message = 'Задача согласована <a href = "http://control.maint.kz/tasks/">'.$title.'</a> согласовал: <a href = "#">'.$parent_info.'</a>';
					$color = "bg-success-400";
				} 
				$icon = "icon-cube3";
			}
			$model->message = $message;
			$model->title = $title;
			$model->color = $color;
			$model->icon = $icon;
			$model->save();
			
			$user = Users::model()->findByPk($user_id);
			
			$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
			$headers .= "From: Maint Control <info@maint.kz>\r\n"; 

			$email = $user->login."@maint.kz";
			
			mail($email, $subject, $message, $headers); 
		}
		
	}
?>