<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');
		
		$photos['imageSource'] = $this->user_model->getCarouselPhotos();
		$this->load->view('carousel', $photos);
		$data['category'] = $this->user_model->get_random_categories();
		$this->load->view('categories_main', $data);
		$this->load->view('footer');
	}

	public function about() {
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');

		$this->load->view('about');
		$this->load->view('footer');
	}

	public function error() {
		$this->load->view('navbar');
		$this->load->view('error');
		$this->load->view('footer');
	}

	// User validation functions
	public function login() {
		$this->load->model('user_model');
		$data = new stdClass();

		$this->form_validation->set_rules('useremail', 'Email', 'trim|required');
		$this->form_validation->set_rules('userpassword', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run() == false) {
			$this->load->view('navbar');
			$this->load->view('login', $data);
			$this->load->view('footer');
		}
		else {
			$email = $this->input->post('useremail');
			$password = $this->input->post('userpassword');

			if ($this->user_model->is_user($email, $password)) {	
				$username = $this->user_model->get_user($email, $password);
				$userPermissions = $this->user_model->get_userPermissions($email, $password);
				$sessionData = array(
					'username' => (string)$username,
					'logged_in' =>(bool)true,
					'is_admin' => (int)$userPermissions,
				);
				$this->session->set_userdata($sessionData);
				redirect('main');
			}
			else {
				$data->erro = 'Wrong email or password.';
				$this->load->view('navbar');
				$this->load->view('login', $data);
				$this->load->view('footer');
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('main');
	}

	public function register() {
		$this->load->model('user_model');
		$var = new stdClass();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]');
		$this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email|is_unique[project_users.email]', array('is_unique' => 'This email is already registered.'));
		$this->form_validation->set_rules('userpassword', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('userpassword_confirm', 'Password Confirmation', 'trim|required|min_length[6]|matches[userpassword]');

		if ($this->form_validation->run() == false) {	
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$id = $this->user_model->get_user_id($session_data['username']);
				$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
				$this->load->view('navbar', $data);
			}
			else 
				$this->load->view('navbar');
		
			$this->load->view('register', $var);
			$this->load->view('footer');
		}
		else {
			$username = $this->input->post('username');
			$email = $this->input->post('useremail');
			$password = $this->input->post('userpassword');
			
			if($this->session->userdata('is_admin')) 
				$usertype = $this->input->post('usertype');	
			else 
				$usertype = '0';

			if ($this->user_model->create_user($username, $email, $password, $usertype)) {
				$sessionData = array(
					'username' => (string)$username,
					'logged_in' =>(bool)true,
					'is_admin' => $usertype,
				);
				$this->session->set_userdata($sessionData);

				redirect('main');
			}
			else {
				$data->error = 'There was a problem creating your new account. Please try again.';
				$this->load->view('navbar');
				$this->load->view('register', $var);
				$this->load->view('footer');
			}
		}
	}
	// End of user validation functions
	
	// Categories Functions
	public function categories() {
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');

		$data['category'] = $this->user_model->get_categories();
		$this->load->view('categories', $data);
		$this->load->view('footer');
	}

	public function category() {
		$category_name = $this->input->get('name');
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');
		
		$data['categoryImages'] = $this->user_model->get_images_from_category($category_name);
		$data['categoryInfo'] = $this->user_model->get_category_data($category_name);
		$this->load->view('category', $data);
		$this->load->view('footer');
	}

	public function createcategory() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {
			$session_data = $this->session->userdata('logged_in');
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);	
			$this->load->view('createcategory');
			$this->load->view('footer');
		}
		else 
			redirect('main');
	}

	public function addcategory() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {	
			$data = array(
				'name' => $this->input->post('name'),
				'source' => $this->input->post('source'),
			);

			if ($this->user_model->add_category($data)) 
				redirect('main/categories');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}

	public function editcategory() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {
			$category_name = $this->input->get('name');
			$data['categoryInfo'] = $this->user_model->get_category_data($category_name);
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
			$data['categoryImages'] = $this->user_model->get_images_from_category($category_name);
			$data['categoryInfo'] = $this->user_model->get_category_data($category_name);
			$this->load->view('editcategory', $data);
			$this->load->view('footer');
		}
		else
			redirect('main');	
	}

	public function updatecategory() {
		$this->load->model('user_model');
		$id = $this->input->get('id');

		if($this->session->userdata('is_admin')) {	
			$data = array(
				'name' => $this->input->post('name'),
				'source' => $this->input->post('source'),
			);

			if ($this->user_model->update_category($id, $data)) 
				redirect('main/categories');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}

	public function deletecategory() {
		$this->load->model('user_model');
		$id = $this->input->get('id');

		if($this->session->userdata('is_admin')) {	
			if ($this->user_model->delete_category($id)) 
				redirect('main/categories');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}
	// End of categories function

	// Products functions
	public function products() {
		$this->load->model('user_model');
	
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');

		if ($this->user_model->get_products()) {
			$data['product'] = $this->user_model->get_products();
			$this->load->view('products', $data);
			$this->load->view('footer');
		}	
		else 
			redirect('main/error');
	}

	public function product() {
		$this->load->model('user_model');
		$product_id = $this->input->get('id');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
		}
		else 
			$this->load->view('navbar');
		
		$data['product'] = $this->user_model->get_product_data($product_id);
		$this->load->view('product', $data);
		$this->load->view('footer');
	}

	public function createproduct() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {
			$data['category'] = $this->user_model->get_categories();
			$session_data = $this->session->userdata('logged_in');
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
			$this->load->view('createproduct', $data);
			$this->load->view('footer');
		}
		else 
			redirect('main');
	}

	public function addproduct() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {	
			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'price' => $this->input->post('price'),
				'category' => $this->input->post('category'),
				'added_at' => date('Y-m-j H:i:s'),
				'source' => $this->input->post('source')
			);

			if ($this->user_model->add_product($data)) 
				redirect('main/products');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}

	public function updateproduct() {
		$this->load->model('user_model');
		$id = $this->input->get('id');

		if($this->session->userdata('is_admin')) {	
			$data = array(
				'description' => $this->input->post('description'),
				'price' => $this->input->post('price'),
				'added_at' => $this->input->post('added_at'),
				'source' => $this->input->post('source')
			);

			if ($this->user_model->update_product($id, $data)) 
					redirect('main/product?id='.$id);	
			else 
				redirect('main/error');
		}
		else {
			redirect('main');
		}
	}

	public function deleteproduct() {
		$this->load->model('user_model');
		$id = $this->input->get('id');

		if($this->session->userdata('is_admin')) {	
			if ($this->user_model->delete_product($id)) 
				redirect('main/products');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}
	// End of product functions

	// User functions
	public function users() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {	
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$id = $this->user_model->get_user_id($session_data['username']);
				$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
				$this->load->view('navbar', $data);
			}
			else 
				$this->load->view('navbar');

			$data['users'] = $this->user_model->get_users();
			$this->load->view('users', $data);
			$this->load->view('footer');
		}
		else
			redirect('main/error');
	}

	public function user() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {
			$id = $this->input->get('id');
			$data['user'] = $this->user_model->get_user_data($id);
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);
			$this->load->view('user', $data);
			$this->load->view('footer');
		}
		else
			redirect('main');
	}

	public function updateuser() {
		$this->load->model('user_model');

		if($this->session->userdata('is_admin')) {
			$id = $this->input->get('id');
			$username = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->form_validation->set_rules('name', 'Username', 'trim|required|alpha_numeric|min_length[4]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			if (strlen($password)) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('passwordConfirmation', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
			}

			if ($this->form_validation->run()) {
				if ($this->user_model->update_user_data($id, $username, $email, $password)) 
					redirect('main/users');
				else
					redirect('main/error');
			}
			else
				redirect('main/error');
		}
	}

	public function deleteuser() {
		$this->load->model('user_model');
		$id = $this->input->get('id');

		if($this->session->userdata('is_admin')) {	
			if ($this->user_model->delete_user($id)) 
				redirect('main/users');	
			else 
				redirect('main/error');
		}
		else 
			redirect('main');
	}
	// End of user functions

	// Cart functions
	public function cart() {
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$userID = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($userID);
			$this->load->view('navbar', $data);
			$cartdata['cartitems'] = $this->user_model->get_user_cart($userID);
			$cartdata['cartnumber'] = $this->user_model->get_n_cart_items($userID);
			$cartdata['total'] = $this->user_model->get_total($userID);

			if (!empty($data)) {
				$this->load->view('cart', $cartdata);
				$this->load->view('footer');
			}	
			else 
				redirect('main/error');
		}
		else 
			redirect('main/error');
	}

	public function addtocart() {
		$this->load->model('user_model');
		$productID = $this->input->get('id');
		$username = $this->session->userdata('username');
		$userID = $this->user_model->get_user_id($username); 

		if ($this->user_model->add_product_to_cart($productID, $userID)) 
			redirect('main/products');
		else
			redirect('main/error');
	}

	public function removeproductfromcart() {
		$this->load->model('user_model');
		$productID = $this->input->get('id');
		$username = $this->session->userdata('username');
		$userID = $this->user_model->get_user_id($username); 

		if ($this->user_model->delete_product_from_cart($productID, $userID)) {
			redirect('main/cart');
		}
		else
			redirect('main/error');
	}

	public function success() {
		$this->load->model('user_model');
	
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$id = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($id);
			$this->load->view('navbar', $data);

			if (!$this->user_model->finalize_order($id))
				redirect('main/error');
		}
		else 
			$this->load->view('navbar');
			
		$this->load->view('success');
		$this->load->view('footer');
	}
	// End of cart functions

	// orders function
	public function orders() {
		$this->load->model('user_model');

		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$userID = $this->user_model->get_user_id($session_data['username']);
			$data['cartnumber'] = $this->user_model->get_n_cart_items($userID);
			$this->load->view('navbar', $data);
			$cartdata['cartitems'] = $this->user_model->get_user_orders($userID);
			$cartdata['total'] = $this->user_model->get_total($userID);

			if (!empty($data)) {
				$this->load->view('orders', $cartdata);
				$this->load->view('footer');
			}	
			else 
				redirect('main/error');
		}
		else 
			redirect('main/error');
	}
	// end of orders function	
}