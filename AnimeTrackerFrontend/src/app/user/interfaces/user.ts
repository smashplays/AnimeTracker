export interface Respuesta {
  data: {
    id: number;
    name: string;
    email: string;
    age: number;
  };
  message: string;
  success: boolean;
}
