# see http://www.sitepoint.com/rails-4-quick-look-strong-parameters/ for information on strong params! you need something like @users[params[:first_name]

class UsersController < ApplicationController

  def index
    @user = User.all

  end

  def show
  end

  def new

  end

  def create
    
  end

  def edit
  end

  def update
  end

  def destroy
  end

# private
# def user_params
#   params.require(:user).permit(:first_name, :last_name, :email_address, :password)
# end
end