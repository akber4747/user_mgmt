class User < ActiveRecord::Base
	# attr_accessible :first_name, :last_name, :email_address	


	EMAIL_REGEX = /\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]+)\z/i
	validates :email_address, presence: true, uniqueness: { case_sensitive: false }, format: { with: EMAIL_REGEX }
	validates :first_name, :last_name, :email_address, :password, presence: true
	before_save {self.email_address = email_address.downcase}
	
end
