<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .report-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .report-header h2 {
            font-weight: 600;
            color: #0d6efd;
        }

        .report-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        th {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            font-weight: 600;
            font-size: 0.9rem;
        }

        td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        tfoot td {
            background-color: #f8fafc;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            font-size: 0.85rem;
            color: #94a3b8;
            margin-top: 2rem;
        }
    </style>
</head>
<body class="p-4">

    <div class="container-fluid">

        <div class="report-header">
            <h2>Relatório de Produtos em Estoque</h2>
            <p>Resumo atualizado de todos os produtos cadastrados no sistema</p>
        </div>

        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Fornecedor</th>
                    <th class="text-end">Qtd</th>
                    <th class="text-end">Preço Unit.</th>
                    <th class="text-end">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produtos as $produto)
                    <tr>
                        <td class="text-muted">{{ $produto->id }}</td>
                        <td class="fw-semibold">{{ $produto->nome }}</td>
                        <td class="text-muted">{{ $produto->descricao ?? '-' }}</td>
                        <td>{{ $produto->fornecedor->nome ?? '-' }}</td>
                        <td class="text-end">{{ $produto->quantidade ?? 0 }}</td>
                        <td class="text-end">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td class="text-end text-primary fw-semibold">
                            R$ {{ number_format(($produto->quantidade ?? 0) * $produto->preco, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Nenhum produto encontrado no estoque.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            @if($produtos->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="6" class="text-end">Valor total em estoque:</td>
                    <td class="text-end text-success">
                        <strong>
                            R$
                            {{ number_format($produtos->sum(fn($p) => ($p->quantidade ?? 0) * $p->preco), 2, ',', '.') }}
                        </strong>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>

        <div class="footer">
            <p>Gerado automaticamente em {{ now()->format('d/m/Y H:i') }} — <strong>VersaShop</strong></p>
        </div>

    </div>

</body>
</html>
