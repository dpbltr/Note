public function user_login()
	{
		if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
			if ($_POST) {
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('password', 'Password', 'required');
				if ($this->form_validation->run() != FALSE) {

					$email = $this->input->post('email');
					$password = $this->input->post('password');
					$result = $this->customer_model->user_login($email, $password);
					if ($result !== FALSE && !empty($result)) {
						$this->session->set_userdata('id', $result);
						$this->load->view('showdata');
					} else {
						$this->session->set_flashdata('message', 'Your credentials are not valid');
						return redirect('customer/user_login');
					}
				} else {
					$this->session->set_flashdata('message', 'Your credentials are not valid');
					return redirect('customer/user_login');
				}
			} else {
				$this->load->view('login');
			}
		} else {
			$this->load->view('showdata');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		redirect('customer/user_login');
	}