<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubcategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            [
                'Salário',
                '13º salário',
                'Dividendos',
                'Férias',
                'Horas extras',
                'IR',
                'Outras Receitas',
                'Pensão',
                'Resgate Investimentos',
                'Transferência entre contas',
                'Paizão',
                'Mozão'
            ],
            [
                'Fundo de Emergência',
                'Fundos de Investimentos',
                'LCI & LCA',
                'Poupança',
                'Previdencia Privada',
                'Renda Fixa',
                'Renda Variável',
                'Tesouro Direto',
                'Outras Poupança & Investimento'
            ],
            [
                'Celular',
                'Condomínio',
                'Consumo de água',
                'Decoração da Casa',
                'Energia Elétrica',
                'Gás',
                'Internet / TV a cabo',
                'IPTU',
                'Manutenção / Reforma da casa',
                'Prestação /Aluguel de imóvel',
                'Serviço de Limpeza (diarista)',
                'Telefone Fixo',
                'Outras Moradias'
            ],
            [
                'Feira  / Sacolão',
                'Padaria',
                'Restaurante',
                'Supermercado',
                'Outras (café, água, sorvetes, etc)'
            ],
            [
                'Combustível',
                'Estacionamento',
                'Financiamento de Veículo',
                'IPVA',
                'Lavagem',
                'Licenciamento',
                'Manutenção',
                'Ônibus / Metrô',
                'Pedágio',
                'Multa',
                'Taxi / Uber',
                'Outras Transporte',
                'Seguro'
            ],
            [
                'Material Escolar',
                'Matricula Escolar/ Mensalidade',
                'Outros Cursos',
                'Transporte Escolar',
                'Outras Educacão'
            ],
            [
                'Bares',
                'Cinema / Teatro / Shows',
                'Clube / Parques / Casa Noturna',
                'Festas',
                'Livros / Revistas / CDs',
                'Restaurantes',
                'Streaming (Netflix / Amazon / Disney)',
                'Viagens / Férias',
                'Outras Lazer'
            ],
            [
                'Academia',
                'Cabelereiro',
                'Higiene Pessoal',
                'Manicure',
                'Plano de Saúde',
                'Outras Saúde & Beleza',
                'Farmácia'
            ],
            [
                'Empréstimos',
                'Imposto de Renda a Pagar',
                'Juros Cheque Especial',
                'Pagamento de Dívidas',
                'Previdência Privada',
                'Seguros (vida/residencial)',
                'Tarifas Bancárias',
                'Outras Serviços Financeiros'
            ],
            [
                'Acessórios',
                'Calçados',
                'Roupas',
                'Outras Vestuário'
            ],
            [
                'Doações',
                'Presentes',
                'Outras Doações  & Presentes'
            ],
            [
                'Acessórios Animal de Estimação',
                'Banho / Tosa',
                'Brinquedos',
                'Hotel',
                'Medicamento',
                'Ração',
                'Veterinário',
                'Outras Animal de Estimação'
            ],
            [
                'Outras',
                'Tranferência entre contas',
                'Cartão de crédito',
                'Seguro Odonto'
            ]
        ];

        foreach($subcategories as $sub){
            $id = 1;
            foreach($sub as $subcat){
                Subcategory::create([
                    'user_id' => 1,
                    'name' => $subcat,
                    'category_id' => $id,
                ]);
            }
            $id++;
        };
    }
}
