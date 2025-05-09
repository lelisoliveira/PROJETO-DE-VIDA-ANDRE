<?php
class Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Atualiza ou insere o texto "sobre mim" do usuário
    public function sobremim($user_id, $sobre_mim)
    {
        $sql = "UPDATE users SET sobre_mim = :sobre_mim WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':sobre_mim' => $sobre_mim,
            ':user_id' => $user_id
        ]);
    }

    // Insere os dados na tabela quemsou
    public function salvarQuemSou(
        $user_id, $fale_sobre_voce, $minhas_lembrancas, $pontos_fortes, $pontos_fracos, $meus_valores, 
        $minhas_aptidoes, $meus_relacionamentos, $o_que_gosto, $o_que_nao_gosto, $rotina_lazer_estudos, 
        $minha_vida_escolar, $visao_fisica, $visao_intelectual, $visao_emocional, $visao_pessoas_sobre_mim, 
        $autovalorizacao
    ) {
        $sql = "INSERT INTO quemsou 
            (user_id, fale_sobre_voce, minhas_lembrancas, pontos_fortes, pontos_fracos, meus_valores, 
            minhas_aptidoes, meus_relacionamentos, o_que_gosto, o_que_nao_gosto, rotina_lazer_estudos, 
            minha_vida_escolar, visao_fisica, visao_intelectual, visao_emocional, visao_pessoas_sobre_mim, 
            autovalorizacao) 
            VALUES 
            (:user_id, :fale_sobre_voce, :minhas_lembrancas, :pontos_fortes, :pontos_fracos, :meus_valores, 
            :minhas_aptidoes, :meus_relacionamentos, :o_que_gosto, :o_que_nao_gosto, :rotina_lazer_estudos, 
            :minha_vida_escolar, :visao_fisica, :visao_intelectual, :visao_emocional, :visao_pessoas_sobre_mim, 
            :autovalorizacao)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_id' => $user_id,
            ':fale_sobre_voce' => $fale_sobre_voce,
            ':minhas_lembrancas' => $minhas_lembrancas,
            ':pontos_fortes' => $pontos_fortes,
            ':pontos_fracos' => $pontos_fracos,
            ':meus_valores' => $meus_valores,
            ':minhas_aptidoes' => $minhas_aptidoes,
            ':meus_relacionamentos' => $meus_relacionamentos,
            ':o_que_gosto' => $o_que_gosto,
            ':o_que_nao_gosto' => $o_que_nao_gosto,
            ':rotina_lazer_estudos' => $rotina_lazer_estudos,
            ':minha_vida_escolar' => $minha_vida_escolar,
            ':visao_fisica' => $visao_fisica,
            ':visao_intelectual' => $visao_intelectual,
            ':visao_emocional' => $visao_emocional,
            ':visao_pessoas_sobre_mim' => $visao_pessoas_sobre_mim,
            ':autovalorizacao' => $autovalorizacao
        ]);
    }

    // Método para listar dados de 'Quem Sou Eu' com base no user_id
    public function listarQuemSou($user_id) {
        // Aqui, utilize a tabela correta "quemsou" (ou "quem_sou" dependendo de sua necessidade)
        $sql = "SELECT * FROM quemsou WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":user_id" => $user_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna o registro encontrado ou null
    }
}
?>
