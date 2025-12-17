import ProdutosProvider from "./contexts/ProdutosProvider.jsx";
import { AuthProvider } from "./contexts/AuthProvider.jsx";
import { FornecedorProvider } from "./contexts/FornecedorProvider.jsx";
import { AppRoutes } from "./routes/AppRoutes.jsx";

function App() {
    return (
        <AuthProvider>
            <FornecedorProvider>
                <ProdutosProvider>
                   <AppRoutes/>
                </ProdutosProvider>
            </FornecedorProvider>
        </AuthProvider>
    );
}

export default App;
