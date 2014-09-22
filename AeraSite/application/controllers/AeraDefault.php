<?php

	public function viewpage($includes = TRUE)
	{
        $this->load->helper('url');

		$this->inputs["RAND"]	= time();
		
		//Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
		$this->aera->page($this->designpath, $this->designfile, $this->designtype);
		$this->aera->pushlinks($this->aeravars->links);
		$this->aera->push($this->aeravars->sys);
		$this->aera->push($this->inputs);
		
		if ($this->session->userdata('username'))
		{
			$this->aera->push('name', $this->session->userdata('username'));
			$this->aera->push('uid', $this->session->userdata('uid'));
		}
		if ($includes)
			$this->data['header'] = $this->aera->loadheader();
		$this->data['content'] = $this->aera->loadpage();
		if ($includes)
			$this->data['footer'] = $this->aera->loadfooter();
		$this->load->vars($this->data);
		if ($includes)
			$this->load->view('header');
		$this->load->view('page');
		if ($includes)
			$this->load->view('footer');
	}
	public function setpage()
	{
		$this->aera->page($this->designpath, $this->designfile, $this->designtype);
		if ($this->session->userdata('username'))
		{
			$this->load->database("default");
			$this->uid = $this->session->userdata($this->primarykey);
			$query = $this->db->query("select * from users where ID=".$this->uid);
			$this->user = $query->row_array();
		}
		else
			$this->uid = 0;
	}
	public function set($path = NULL, $file = NULL, $type = NULL)
	{
		if ($path == NULL)
		{
			$path = $this->designpath;
			$file = $this->designfile;
			$type = $this->designtype;
		}
		$this->designpath				= $path;
		$this->designfile				= $file;
		$this->designtype				= $type;
		$this->setpage();
		if ($this->session->userdata('username'))
			$this->uid = $this->session->userdata($this->primarykey);
		else
			$this->uid = 0;
	}
	