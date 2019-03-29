<?php 
	class VideoDetailsFormProvider
	{
		private $con;
		public function __construct($con)
		{
			$this->con = $con;
		}
		public function createUploadForm()
		{
			$fileInput  = $this->createFileInput();
			$titleInput = $this->createTitleInput();
			$descriptionInput = $this->createDescriptionInput();
			$privacyInput = $this->createPrivacyInput();
			$categoryInput = $this->createCategoriesInput();
			$button = $this->createUploadButton();
			return " <form action = 'processing.php' method = 'POST' enctype='multipart/form-data'>
					$fileInput
					$titleInput
					$descriptionInput
					$privacyInput
					$categoryInput$button
			</form>";
		}

		private function createFileInput()
		{
			return "<div class='form-group'>
						<label for='exampleFormControlFile1'>Your File</label>
						<input type='file' class='form-control-file' id='exampleFormControlFile1' name = 'fileInput' required>
					</div>";
		}

		private function createTitleInput()
		{
			return "<div class='form-group'>
			<input class='form-control' type='text' placeholder='Title' name = 'titleInput'> 
			</div>";
		}

		private function createDescriptionInput()
		{
			return "<div class='form-group'>
			<textarea class='form-control'  placeholder='Title' name = 'descriptionInput' rows = '3'> </textarea>
			</div>";
		}

		private function createPrivacyInput()
		{
			return "
			<div class='form-group'>
				<select class='form-control' name = 'privacyInput'>
			      <option value = '0'>private</option>
			      <option value = '1'>public</option>
			    </select>
		    </div>
			";
	
		}

		private function createCategoriesInput()
		{
			$query = $this->con->prepare("SELECT * FROM catagories");
			$query->execute();

			$html = "<div class='form-group'>
				<select class='form-control' name = 'categoryInput'>";
			while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					$name = $row['name'];
					$id = $row['id'];
					$html .="<option value = '".$id."'>".$name."</option>";
				}

			$html .= " </select>
		    </div>";
		    return $html;
		}
		private function createUploadButton()
		{
			return "<button type = 'submit' class = 'btn btn-primary' name = 'uploadButton' >UPLOAD</button>"; 
		}
	}
 ?>