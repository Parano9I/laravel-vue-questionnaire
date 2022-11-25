export interface CreateUserParams {
  name: string;
  email: string;
  password: string;
  confirmed_password: string;
}

export interface LoginParams {
  email: string;
  password: string;
}

export interface UserResponseModel {
  status: string;
  data: {
    user: {
      id: number;
      name: string;
      email: string;
      token: string;
    };
    tokens: {
      type: string;
      access_token: string;
    };
  };
}
