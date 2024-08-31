<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Akira - Vol. 06',
                'description' => 'Confira o destino final de Tetsuo, Kaneda e todos os sobreviventes no último volume de Akira!',
                'year_of_publication' => 2023,
                'isbn' => '8545712375',
                'image_path' => 'akira.jpg',
            ],
            [
                'title' => 'Misto-quente',
                'description' => 'Para Henry Chinaski -protagonista desta obra-, o que pode ser pior do que crescer nos Estados Unidos da recessão pós-1929 é ser pobre, de origem alemã, ter muitas espinhas, um pai autoritário beirando a psicopatia, uma mãe passiva e ignorante, nenhuma namorada e, pela frente, apenas a perspectiva de servir de mão de obra barata em um mundo cada vez menos propício às pessoas sensíveis e problemáticas.',
                'year_of_publication' => 2005,
                'isbn' => '8525414654',
                'image_path' => 'misto-quente.jpg',
            ],
            [
                'title' => 'Desenvolvendo aplicativos com GPT-4 e ChatGPT: Crie chatbots inteligentes, geradores de conteúdo e muito mais',
                'description' => 'Este livro é um guia abrangente para desenvolvedores Python que desejam aprender a criar aplicações com grandes modelos de linguagem. Os autores Olivier Caelen e Marie-Alice Blete abordam os principais recursos e benefícios do GPT-4 e ChatGPT e explicam como eles funcionam. Você também encontrará um guia passo a passo para o desenvolvimento de aplicações com o uso da biblioteca Python para GPT-4 e ChatGPT, incluindo geração de texto, perguntas e respostas, e ferramentas de resumo de conteúdo. Escrito em linguagem clara e concisa, Desenvolvendo aplicativos com GPT-4 e ChatGPT contém exemplos fáceis de seguir para ajudá-lo a entender os conceitos e aplicá-los aos seus projetos. Exemplos de código Python estão disponíveis em um repositório do GitHub e o livro inclui um glossário com os principais termos. Pronto para se beneficiar do poder dos grandes modelos de linguagem em suas aplicações? Este livro é obrigatório. Você aprenderá: • Os aspectos básicos e benefícios do ChatGPT e GPT-4 e como eles funcionam • A integrar esses modelos em aplicações baseadas em Python para tarefas de NLP • A desenvolver aplicações usando as APIs do GPT-4 ou ChatGPT em Python para geração de texto, respostas a perguntas, e resumo de conteúdo, entre outras tarefas • Tópicos avançados sobre o GPT, incluindo engenharia de prompt, modelos de ajuste fino para tarefas específicas, plugins, LangChain e muito mais',
                'year_of_publication' => 2023,
                'isbn' => '8575228749',
                'image_path' => 'desenvolvendo-aplicativos-com-gpt-4.jpg',
            ],
            [
                'title' => 'Misto-quente',
                'description' => 'A poluição tomou conta do mundo. As águas, o ar e as florestas foram contaminados por causa do crescimento da industrialização. É nesse mundo caótico, onde até mesmo o ar é venenoso, e sem esperança que Nausicaä do Vale do Vento enfrentará uma jornada que decidirá o futuro da humanidade.',
                'year_of_publication' => 2022,
                'isbn' => '6555942525',
                'image_path' => 'nausicaä-do-vale-do-vento-vol-01.jpg',
            ],
            [
                'title' => 'Fundamentos da Arquitetura de Software: uma Abordagem de Engenharia: 1',
                'description' => 'Fundamentos da Arquitetura de Software No mundo inteiro, pesquisas de salário colocam sistematicamente a arquitetura de software entre os dez melhores empregos, embora não exista nenhum guia real para ajudar os desenvolvedores a se tornarem arquitetos. Até agora. Este livro fornece a primeira visão geral completa de muitos aspectos da arquitetura de software. Aspirantes a arquitetos e os já praticantes examinarão da mesma forma as características e padrões da arquitetura, a determinação de componentes, as arquiteturas de diagramação, de apresentação, evolucionária e muitos outros tópicos. Mark Richards e Neal Ford, profissionais experientes que ensinam arquitetura de software profissionalmente há anos, focam os princípios da arquitetura que se aplicam a todas as camadas da tecnologia. Você explorará a arquitetura de software de um ponto de vista moderno, levando em conta todas as inovações da última década. Este livro examina: Padrão da arquitetura: a base técnica para muitas decisões de arquitetura. Componentes: identificação, acoplamento, coesão, particionamento e granularidade. Habilidades sociais: gestão eficiente da equipe, reuniões, negociação, apresentações etc. Modernidade: práticas de engenharia e abordagens operacionais que mudaram radicalmente nosúltimos anos. Arquitetura como disciplina de engenharia: resultados repetidos, métricas e avaliações concretas que acrescentam rigor à arquitetura de software. *** “Quer seja novo na função ou se já é arquiteto há anos, este livro o ajudará a ser melhor no seu trabalho. Só gostaria que ele tivesse sido escrito antes na minha carreira.” ―Nathaniel Schutta “Arquiteto como serviço”, netschutta.io “Este livro servirá como um guia para muitos em sua jornada no domínio da arquitetura de software.” ―Rebecca J. Parsons CTO, ThoughtWorks',
                'year_of_publication' => 2022,
                'isbn' => '8550819859',
                'image_path' => 'fundamentos-da-arquitetura-de-software.jpg',
            ],
            [
                'title' => 'JavaScript: O Guia Definitivo',
                'description' => 'Referência completa para programadores, JavaScript: O guia definitivo fornece uma ampla descrição da linguagem JavaScript básica e das APIs JavaScript do lado do cliente definidas pelos navegadores Web. Em sua 6ª edição, cuidadosamente reescrita para estar de acordo com as melhores práticas de desenvolvimento Web atuais, abrange ECMAScript 5 e HTML5 e traz novos capítulos que documentam jQuery e JavaScript do lado do servidor. Recomendado para programadores experientes que desejam aprender a linguagem de programação da Web e para programadores JavaScript que desejam ampliar seus conhecimentos e dominar a linguagem, este é o guia do programador e manual de referência de JavaScript completo e definitivo.',
                'year_of_publication' => 2012,
                'isbn' => '856583719X',
                'image_path' => 'javascript-guia-definitivo.jpg',
            ],
        ];

        foreach ($books as &$book) {
            $imagePath = public_path("book_images/{$book['image_path']}");
            $imageName = Str::random(10) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
            Storage::disk('s3')->put("books/{$book['isbn']}/{$imageName}", file_get_contents($imagePath));
            $book['image_path'] = "books/{$book['isbn']}/{$imageName}";
        }

        foreach ($books as $bookData) {
            $author = Author::factory()->create();
            Address::factory()->create(['author_id' => $author->id]);

            Book::create([
                'title' => $bookData['title'],
                'description' => $bookData['description'],
                'year_of_publication' => $bookData['year_of_publication'],
                'isbn' => $bookData['isbn'],
                'image_path' => $bookData['image_path'],
                'author_id' => $author->id,
            ]);
        }
    }
}
