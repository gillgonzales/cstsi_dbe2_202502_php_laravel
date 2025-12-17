/* eslint-disable react/prop-types */
import { Navigate } from "react-router";
import { useAuthContext } from "../contexts/AuthProvider";

export default function PrivateRoute({ children }){
  const { user } = useAuthContext();
  return user ? children : <Navigate to="/login" />;
};
