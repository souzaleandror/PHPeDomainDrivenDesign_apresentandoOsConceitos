#### 18/02/2024

Curso de PHP e Domain Driven Design: apresentando os conceitos

@01-Linguagem ubíqua

@@01
Introdução

[00:00] Boas-vindas à Alura! Meu nome é Vinicius Dias, embora vocês não estejam me vendo eu vou acompanhar vocês nesse treinamento de introdução a alguns conceitos do Domain Driven Design, ou DDD, utilizando PHP.
[00:15] Primeiro nós vamos falar sobre o que é DDD, que nada mais é do que realizar o design da nossa aplicação, ou seja, modelar nossa aplicação partindo do domínio. E nós já falamos muito sobre isso nos cursos de arquitetura, no curso anterior sobre arquitetura.

[00:30] Então nós vamos partir exatamente desse treinamento de arquitetura. A partir daquele treinamento nós vamos começar com essa estrutura e vamos evoluindo, onde aqui no nosso domínio nós vamos adicionar uma invariante na nossa classe de aluno, na nossa entidade, e a partir disso nós vamos entender o que é um aggregate root, nós vamos entender sobre particularidades na persistência disso.

[00:51] E evoluindo, nós vamos falar um pouco sobre evento de domínio. Nós vamos entender o que são eventos de domínio e como eles podem ser úteis. Além de implementar um evento, obviamente, nós vamos aprender a publicar esse evento e a ouvir esse evento e reagir a ele.

[01:06] Evoluindo um pouco nos estudos de DDD, falando sobre padrões táticos e estratégicos, nós vamos conversar um pouco sobre o que é linguagem ubíqua e outro padrão de estratégico que nós vamos conversar é sobre os contextos delimitados ou Bounded Context.

[01:23] Nós vamos separar nossa aplicação em dois contextos: o contexto acadêmico e o contexto de gamificação, onde cada um deles, apesar de precisar se comunicar, não vão se conversar diretamente. Esses dois contextos vão ser independentes e vão utilizar um conceito que é chamado de shared kernel, ou núcleo compartilhado, para poder compartilhar algumas informações.

[01:46] No final do treinamento, nós ainda vamos bater um papo bem rápido sobre sistemas distribuídos, embora nós não vamos implementar essa parte na prática, vai ser um papo interessante para nós entendermos como um sistema separado em contextos pode acabar evoluindo para uma arquitetura de microsserviços, ou qualquer outra arquitetura de sistemas distribuídos.

[02:06] Espero que você aproveite bastante esse treinamento! É um treinamento um pouco mais denso, de um conteúdo um pouco mais avançado. Então, caso fique com dúvidas durante o treinamento não hesite, abra uma dúvida no fórum. Eu tento responder pessoalmente sempre que possível, mas quando eu não consigo, a nossa comunidade de alunos e de moderadores é muito solícita, e com certeza alguém vai conseguir te ajudar.

[02:27] E lá no final, obviamente, eu vou deixar algumas referências para você se aprofundar nesse conteúdo de Domain Driven Design, arquitetura, etc.

[02:35] Então vamos para o próximo vídeo para nós fazermos aquela recapitulação do curso de arquitetura e depois começar a colocar a mão na massa.

@@02
Apresentação do projeto

[00:00] Vamos dar só uma passada no projeto do curso anterior para todo mundo entender o que nós estamos falando.
[00:08] No treinamento anterior, onde fizemos uma rápida introdução sobre o que é que uma arquitetura de software e nós montamos uma arquitetura para nossa aplicação, inclusive com alguns testes. Nós vimos um projeto onde nós teríamos alunos, esses alunos poderiam indicar outros alunos, etc.

[00:23] Alguns desafios foram deixados, para que vocês fossem fazendo durante o treinamento, mas aqui eu só vou mostrar os arquivos que foram feitos durante o treinamento junto comigo. Então aqui na nossa aplicação nós temos o use case, nós temos aquele application service.

[00:38] Ou aquele nosso caso de uso, de matricular um aluno e para matricular aluno nós precisamos dos dados dele, do CPF, nome e e-mail. E com isso, nós realizamos o fluxo da nossa aplicação, onde nós criávamos esse aluno, adicionava esse aluno no repositório, etc.

[00:55] Nós temos a parte de indicação, onde nós começamos a criar uma Interface para enviar e-mail de indicação quando aluno fosse indicado, etc. No nosso domínio, nós temos tudo referente ao aluno, seja a sua entidade, os value objects relacionados à ele, as exceções caso existissem algumas, algumas interfaces. E relacionado a indicação, nós não entramos muito nesses detalhes então nós só temos uma entidade.

[01:23] E aqui nós tomos os value objects que são genéricos no nosso domínio da aplicação, que podem ser utilizados tanto na indicação, quanto no aluno, ou em qualquer outro módulo que nós viéssemos a desenvolver por aqui.

[01:37] Então com isso, nós temos o nosso domínio e para implementação de algumas partes do domínio nós temos em infraestrutura, onde nós cuidamos de criptografia de senha, cuidamos de repositório, etc. Inclusive com esse repositório em memória, nós vimos que ia ser mais fácil criar alguns testes, etc.

[01:56] Com esse projeto já em mente, vamos começar a falar um pouco, a bater um papo sobre o que é Domain Driven Design, ou seja, desenvolvimento guiado a domínio. E essa palavra domínio, já está escrito aqui na nossa arquitetura, nós já começamos a montar nosso sistema pensando nela.

[02:15] E se nós já começamos a pensar no nosso domínio, se o domínio já faz parte da nossa aplicação, já faz parte do nosso sistema, enquanto nós desenvolvemos no curso anterior, talvez nós já tenhamos feito algumas coisas, talvez nós já tenhamos implementado algumas técnicas que o estudo de DDD, o Domain Driven Design, ou o desenvolvimento guiado a domínio, talvez nós já tenhamos implementado algumas coisas sugeridas nessa literatura.

[02:40] Então no próximo vídeo, nós vamos ver exatamente isso, o que do nosso projeto já está em conformidade aos estudos de DDD. Então o que nós fizemos até aqui que já fazem parte do estudo de “DDD”. Então no próximo vídeo nós batemos esse papo

@@03
O que já aprendemos

[00:00] No treinamento anterior, nós trabalhamos bastante com essa imagem. Representação da interação entre camadas User interface, Application, Domain e Infrastructure
[00:06] Essa imagem foi mostrada mais de uma vez, e essa imagem é uma imagem tirada do livro que originou o estudo do DDD e nessa imagem nós já começamos a pegar alguns detalhes, nós já começamos a pegar alguns insights para aplicar no nosso sistema.

[00:25] Então se você reparar, nós temos três camadas da nossa arquitetura: aplicação, domínio e infraestrutura. E essas três camadas são sugeridas pelo DDD.

[00:35] Na sugestão que é feita no livro do DDD existem algumas diferenças, por exemplo, no livro do DDD é sugerido que o domínio possa utilizar alguns detalhes de infraestrutura, da mesma forma que aplicação pode utilizar alguns detalhes de infraestrutura.

[00:52] Mas nós vimos no nosso estudo de arquitetura que é interessante isolar o domínio da infraestrutura, de forma que ele nunca dependa de nada diretamente. Então nós fizemos aquela inversão de dependência, criando as nossas interfaces. Tanto para cifrar senha, quanto para tratar repositório de alunos.

[01:11] Mas o conceito da arquitetura nós já começamos a fazer utilizando conceitos do DDD. Então essa arquitetura separada em camadas, onde o domínio é uma camada separada, é algo independente, faz parte do estudo de DDD.

[01:28] Então antes de tudo, é importante ressaltar, eu já falei no vídeo anterior, mas que DDD significa domain driven design, ou seja, design, modelagem orientado a domínio, ou seja, o mais importante na nossa aplicação é o domínio. Nós pensamos no domínio, e a partir do domínio nós desenvolvemos nossa aplicação, adiciona detalhes de infraestrutura, etc.

[01:53] E uma coisa que nós não fizemos na nossa aplicação, não fizemos no nosso sistema, foi essa camada de interface com o usuário. Eu deixei como desafio para que vocês pensassem nessa camada. E nesse treinamento nós também não vamos tratar ela, porque essa camada pode ser implementada de inúmeras formas, nós lá no final do treinamento vamos falar um pouquinho sobre as possibilidades. Mas de novo, isso vai ser um desafio para vocês tentarem.

[02:17] Mas voltando para a parte que nós já estudamos e vamos nos aprofundar mais, sobre o DDD, nós vimos a necessidade de cada uma dessas camadas e para implementar detalhes de cada uma dessas camadas, nós já vimos conceitos que a literatura do DDD ensina para nós. Então vamos dar uma passada bem rápida sobre o que nós já vimos.

[02:36] Nós começamos falando sobre entidades, que são classes no nosso sistema que vão gerar objetos com identidade, e no nosso caso a gente utilizou CPF como identidade. Então o conceito de entidade é um estudo muito focado do DDD. Nos livros de DDD existem capítulos específicos sobre entidade tratando sobre esses detalhes.

[03:01] Por exemplo, eu comentei no curso anterior que nós iriámos utilizar CPF como chave primária, vamos dizer assim, como identificador único de cada um dos alunos. Eu poderia utilizar um ID, por exemplo, um private int $id, eu poderia fazer isso e fazer com que o banco de dados gerasse o meu ID.

[03:21] Só que isso, segundo os estudos de domain driven design, está ferindo o meu domínio. Porque um domínio para, por exemplo, um especialista de negócios, um aluno não tem um ID, ele tem um CPF, ele sabe identificar um aluno por um CPF. Então nós trazemos esses detalhes do domínio, da nossa realidade do negócio, para nossa aplicação. E foi exatamente isso que nós fizemos.

[03:43] Então sempre que nós pudermos blindar o nosso domínio de qualquer detalhe de infraestrutura, nós vamos preferir essa abordagem. Lembrando, que toda escolha, toda abordagem no mundo do desenvolvimento têm prós e contras. Aqui nós temos a vantagem de não depender de um banco de dados relacional que gere o ID automaticamente para nós, então existe essa vantagem.

[04:06] Mas a desvantagem é que nós temos que tratar a validação de CPF, esse tipo de detalhe. Então tudo é um trade-off, ou seja, é uma escolha. Nós precisamos pesar as vantagens e desvantagens.

[04:19] Mas beleza, voltando ao assunto de DDD, nós falamos sobre entidade e diretamente relacionados a entidades nós temos os value objects. Value objects são muito semelhantes a entidades, uma diferença de que eles não possuem uma identidade, o que quer dizer, um telefone que tem esse o número e seu DDD iguais, é um telefone igual. Então se eu tenho dois telefones com DDD 24 e o número 22222222, esses dois telefones são iguais, são o mesmo telefone.

[04:50] Então esse conceito de igualdade e identidade é o que divide, é o que diferencia entidades de value objects. Então nós já tratamos bastante sobre isso, já conversamos sobre isso, e avançando um pouco mais a gente falou sobre repositórios. Repositórios também é um conceito citado em DDD. Repositório faz parte do nosso domínio. Toda, ou pelo menos a maioria dos sistemas possuem algum repositório, uma forma de persistir as entidades, de persistir value objects.

[05:23] E esse repositório, embora faça parte do domínio, depende de alguma infraestrutura. Então por nós vimos que deveríamos definir a linha 7 como uma interface, e lá na infraestrutura nós implementaríamos os detalhes, seja utilizando SQL, seja utilizando um banco no SQL, seja utilizando memória, arquivo, o que for. Então nós já vimos mais um conceito, que é o de repositórios.

[05:47] E um conceito um pouco mais complexo, mas que nós temos tratado sem tanta ênfase, desde lá dos nossos cursos de “Orientação objetos”, é o conceito de serviços. Os services são classes que realizam alguma tarefa que não faz parte de nenhuma entidade, porque nossa regra de negócios reside nas entidades como, por exemplo, eu sei como eu adiciono um telefone, eu sei as regras do meu CPF, então nas entidades e nos value objects eu tenho as regras de negócio.

[06:16] Só que se eu possuo alguma regra na minha aplicação ou no meu domínio que não faça parte de nenhuma entidade, eu preciso separar isso em uma classe específica, como é o caso de realizar criptografia de senha. Eu sei que faz parte do meu negócio, eu preciso criptografar a senha dos alunos, só que isso, de novo, depende de detalhes de infraestrutura. Então nós separamos em um serviço de infraestrutura.

[06:40] Então nós temos domain services, que são serviços que organizam regras de várias entidades. Nós temos infrastructure services, ou seja, serviços de infraestrutura, que são serviços, são regras que dependem de algum detalhe de infraestrutura. E nós vimos, o mais complexo e mais polêmico, que são os application services, ou serviços de aplicação, que são os casos de uso, que são o que nós fazemos para organizar o fluxo da aplicação.

[07:10] Por exemplo, em uma aplicação web, você pode entender que um controller é uma espécie de application service. Ele pega a requisição, os dados que vem da requisição, e realiza o fluxo da sua aplicação, chamando as classes necessárias. Só que nesse código nós fomos um passo além e criamos uma classe específica, que não depende da web, e para receber os dados sem depender da web, nós criamos o DTO, ou seja, data transfer object.

[07:37] Isso tudo fez parte da nossa arquitetura, isso tudo tem relação a como separar a nossa aplicação do nosso domínio, da infraestrutura, da web em si. Então vários conceitos aqui, que nós já vimos sobre DDD.

[07:55] Então recapitulando, nós vimos entidades, nós vimos value objects, repositories, nós vimos services, nós falamos sobre factory. Então nós vimos bastante coisa. E isso tudo, todos esses conceitos práticos que nós vimos são chamados dos padrões táticos no DDD, e o DDD é separado em padrões táticos que são essa parte mais prática e os padrões estratégicos.

[08:19] Os padrões estratégicos falam mais sobre como nós nos comunicamos entre a equipe de desenvolvimento e a equipe de negócios, mais relacionada à parte de negócios. Então nós vamos falar sobre o padrão estratégico mais conhecido e mais falado do DDD só que no próximo vídeo.

https://caelum-online-public.s3.amazonaws.com/1774-php-arquitetura-introducao/transcrição+/Aula+1/%5BAula1_Video2_Imagem2%5D.png

@@04
Para saber mais: Building blocks

Os conceitos já aprendidos no curso de arquitetura são diretamente relacionados com o estudo de Domain Driven Design.
Muito do que aprendemos no curso anterior é o que chamamos de Building blocks ou Blocos de construção.

Entity
Value object
Repository
Factory
Service
Todos esses padrões são descritos no estudo sobre DDD e com isso já temos um belo ponto de partida.

Vale ressaltar que o termo Domain Driven Design significa literalmente modelar nosso software nos orientando pelo domínio do negócio.

@@05
Linguagem ubíqua

[00:00] E se você em algum momento pesquisou sobre DDD, sobre Domain Driven Design, sobre design guiado ao domínio, você provavelmente já se deparou com o termo Linguagem Ubíqua, ou Linguagem Onipresente, ou termo em inglês Ubiquitous Language.
[00:22] Esse conceito, essa palavra bonita e isso que recebe capítulos específicos em livros sobre DDD, é um conceito, na verdade, bastante simples. A Linguagem Onipresente ou a Linguagem Ubíqua simplesmente diz que nós precisamos que os especialistas do negócio e os especialistas técnicos, ou seja, nós desenvolvedores, falem a mesma linguagem, nós precisamos que eles utilizem os mesmos termos.

[00:48] Então vamos lá no nosso código entender quando que nós fizemos uso da linguagem ubíqua, vamos pegar no nosso domínio, e nós temos, por exemplo, “AlunoNaoEncontrado.php”. Isso é uma exceção, que diz exatamente o que aconteceu.

[01:04] Quando algum problema relacionado a “AlunoNaoEncontrado” acontecer, eu consigo me comunicar com um especialista de domínio para perguntar para ele, por exemplo, o que precisa acontecer quando tiver um aluno não encontrado, o que eu preciso fazer quando o aluno não for encontrado. Eu utilizo exatamente o termo que está no meu código para me comunicar.

[01:25] Outro detalhe é, por exemplo, na parte de “Indicação.php”. Se ao conversar com especialistas de domínio, eles chamam o aluno que indicou outro aluno de um aluno indicador, eu não utilizaria o nome $indicante, eu colocaria $indicador. Agora se em todas as reuniões, todos os especialistas de negócio da minha da minha empresa falam que é o aluno indicante, eu vou utilizar esse nome $indicante.

[01:51] Então é algo tão simples quanto nomear as coisas corretamente, colocar os nomes de nossas classes, métodos e atributos, exatamente com o nome que nós utilizamos durante reuniões de negócio, por exemplo.

[02:04] Se quando nós conversamos com uma pessoa que está gerenciando a equipe, e essa pessoa não é uma pessoa que programa, não é uma pessoa que desenvolve, não é uma pessoa técnica, nós precisamos conseguir usar termos que estão diretamente no nosso código para conversar com essa pessoa. Então se ao invés de indicação fosse convite, nós não teríamos uma classe chamada Indicação nós teríamos uma classe chamada Convite.

[02:30] Então esses detalhes que parecem bobos, podem evitar grandes problemas em sistemas maiores. Então sempre utilize os nomes que você ouviu de especialistas de domínio, para representar os detalhes no seu programa. E uma coisa que gera uma determinada polêmica é: “Eu devo programar sempre utilizando o idioma nativo da equipe, ou seja, no nosso caso português, quando eu estiver desenvolvendo?”.

[02:57] Para este treinamento, eu tenho desenvolvido em português. Porque eu sei que nem todos os alunos sabem em inglês, e eu sei que pode gerar determinado atrito na hora de passar a informação, caso eu utilize algumas palavras em inglês.

[03:09] A mesma coisa pode ser válida no desenvolvimento com uma equipe, você pode acabar ao utilizar inglês, escrever uma palavra outra errada, tomar algumas decisões que talvez não seriam naturais para uma pessoa que desenvolve utilizando o idioma nativo em inglês.

[03:27] Só que a outra parte tem seus pontos de vantagem, por exemplo, na linha 7, eu estou misturando português eu e inglês, eu tenho na linha 9, a linguagem está escrita em inglês e o meu código em português. Então eu tenho esse atrito entre idiomas, eu tenho esse conflito entre idiomas. Eu tenho na linha 18 data, escrito em português, só que eu tenho date, porque faz parte da linguagem. Então repara que as duas formas têm vantagens e desvantagens.

[03:56] Então caso você e a sua equipe tenham o hábito de desenvolver utilizando termos em inglês, saiba que não existe problema nenhum. Mas, por exemplo, se eu chamasse $aluno de $student, eu preciso entender, eu como desenvolvedor, eu como pessoa que está vendo que o código. Eu preciso saber que esse termo, em uma reunião de negócios vai ser traduzido.

[04:18] Então eu preciso saber que student não é estudante, eu não vou chegar numa reunião e dizer estudante, eu vou dizer aluno. E eu tenho que mentalmente que seja fazer esse tipo de tradução. “Vinicius, isso é um problema?” Longe disso, não é problema nenhum, inclusive para quem já tem determinada intimidade com o idioma inglês, isso não é problema nenhum, pode trazer até a vantagem de você acabar precisando aprender traduções novas.

[04:45] Então, de novo, as duas abordagens têm suas vantagens e desvantagens. E como você preferir seguir com sua equipe, desde que seja um acordo entre a equipe, está ótimo. O que é importante é não utilizar, por exemplo, o termo indicador e depois se comunicar como indicante para equipe de negócios. Utilizar AlunoInexistente e se comunicar AlunoNaoEncontrado para a equipe de negócios.

[05:10] Então nós precisamos ter essa linguagem onipresente, os termos que fazem parte do domínio têm que estar fazendo parte da nossa aplicação, seja em português, que é o nosso idioma nativo, ou em inglês, isso é um som detalhe, mas nós precisamos utilizar os termos corretos. E, basicamente, isso é a linguagem ubíqua. Então é um conceito que, de novo, recebe capítulos, artigos, 1000 vídeos, mas que é um conceito que no seu core, no seu núcleo, é algo muito simples.

[05:39] É utilizar a linguagem que especialistas de domínio entendam, se eu falar o nome de um método, eu preciso que um especialista de domínio sabe do que eu estou falando. Como por exemplo, se eu falar sobre MatricularAluno, que poderia ser um método da minha aplicação, ele vai saber do que eu estou falando. Então esse tipo de detalhe é importante.

[05:59] E embora agora com projetos pequenos, como a gente tem feito durante os cursos, embora isso possa parecer que não faça muita diferença, em um sistema grande isso faz muita diferença, faz muita falta você ter essa linguagem onipresente quando você precisa se comunicar com pessoas fora da equipe técnica.

[06:16] Então tenham isso em mente e levem isso para todo desenvolvimento, mesmo que você não aplique os conceitos que a gente já viu sobre o DDD, utilizando a entidades, repositórios value objects, mesmo que você não utilize esses conceitos, que você faça uma proposta com menos detalhes de orientação a objetos, ainda assim leve o conceito de linguagem onipresente, de linguagem ubíqua para você e para o seu desenvolvimento.

[06:43] Agora que eu já falei bastante e nós já fizemos um resumo do que é Domain Driven Design, vamos passar para o próximo capítulo e finalmente, vocês já devem estar ansiosos, finalmente colocar a mão na massa e desenvolver alguma coisa, vamos começar a apimentar regras do negócio.

@@06
Código em inglês ou em português?

Entendemos que a linguagem ubíqua (ou linguagem onipresente) tem diversas vantagens, porém existe o dilema sobre escrever código em inglês ou em português.
Qual o correto? Escrever código em inglês ou no nosso idioma nativo (português)?

Inglês para não haver atrito entre nosso código e as palavras reservadas da linguagem
 
Alternativa correta
Português para não haver a possibilidade de traduções erradas por pessoas que não falam inglês nativamente
 
Alternativa correta
Não existe certo ou errado nesse caso
 
Alternativa correta! Ambas as abordagens possuem suas vantagens e desvantagens. Cabe à equipe acordar sobre qual abordagem seguir

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aul

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Aprendemos que os estudos de arquitetura e DDD geralmente se complementam;
Entendemos o que é DDD;
Vimos que diversos conceitos de DDD já foram aprendidos no curso de Arquitetura;
Conhecemos o termo Linguagem Ubíqua que consiste em ter uma linguagem onipresente entre a equipe de desenvolvimento e a equipe de negócios.

#### 19/02/2024

@@01
Relação Aluno-Telefone

[00:00] Boas-vindas de volta a mais um capítulo desse treinamento de introdução aos conceitos de DDD utilizando PHP. E agora nós vamos implementar uma regra de negócios bem simples, então esse vídeo vai ser bem curto e no próximo vídeo nós batemos um papo sobre o que acabamos fazendo aqui.
[00:16] Chegou uma regra, o pessoal de negócios virou para equipe de TI e falou, “olha só os nossos alunos têm adicionado inúmeros telefones, só pelo fato de ter telefones para receber mensagens eles estão zoando amigos, colocando o telefone para os amigos receberem notificação. Então nós vamos adicionar uma regra onde cada aluno só pode ter dois telefones no máximo”.

[00:39] Dessa forma, caso o aluno queira informar o telefone fixo e o celular ele vai conseguir, mas nada além disso vai ser utilizado, então nós só temos a possibilidade de ter dois telefones. E repara nisso tudo que eu falei, além de explicar o que nós vamos implementar, eu dei um motivo para nós implementarmos.

[00:57] E quando temos a mentalidade do Design guiado a domínio, da implementação guiada a domínio, nós precisamos entender o que estamos fazendo. Porque eu poderia muito bem receber a ordem de alguém me falar: “Olha só, cada aluno só pode ter dois telefones.” E implementar de alguma forma que nunca isso possa ser mudado, alguma coisa do tipo sem entender o motivo dessa alteração.

[01:20] Então é muito importante que nós sempre entendamos o que estamos fazendo para poder propor a melhor solução. No nosso caso é uma regra muito simples, mas mesmo assim nós precisamos entender o que estamos fazendo.

[01:32] Agora vamos lá, se eu só posso ter dois telefones, antes de adicionar um telefone o que eu vou fazer, eu vou contar o número de telefones que esse aluno já tem. Caso esse número de telefones já seja maior ou igual a 2, eu vou lançar uma exceção, um erro, um problema.

[01:49] E o que nós poderíamos fazer? E eu vou pedir para você fazer, criar uma exceção específica de aluno com dois telefones, ou algum nome que você acredita que faça sentido para o domínio, já que nós não temos uma pessoa especialista de domínios para falar conosco e definir esse nome, nós vamos ser também a pessoa especialista de domínio e inventar esse nome. Eu vou deixar a cargo de vocês criarem essa exceção como exercício.

[02:17] Eu vou aqui lançar na linha 32 uma DomainException. Então, caso esse aluno já tenha dois telefones eu vou informar: Aluno já tem dois telefones. Não pode adicionar outro. Claro que essa mensagem poderia ser escrita de forma diferente, mais amigável, mas o ponto é nós implementamos uma regra muito simples de negócio, mas entendemos o motivo disso estar acontecendo.

[02:48] E só um detalhe que eu esqueci de colocar o tipo de retorno na linha 29 no curso anterior, : self. Então beleza, isso que nós temos é uma invariância, ou seja, uma regra entre duas classes, uma regra entre um relacionamento. Eu sei que um aluno não pode ter mais que dois telefones. Então se o número de telefones já for 2, ele não pode adicionar outro.

[03:14] Caso o número de telefones seja 0 ele consegue? Consegue! Caso o número de telefones seja um ele consegue? Sim! Se for dois, ele já não consegue mais adicionar.

[03:23] E dois desafios então que vão ficar nesse vídeo. Um é criar uma exceção específica para esse caso, e o segundo é criar um teste para esse caso.

@@02
Invariantes

É muito comum que na relação entre 2 (ou mais) classes hajam invariantes, mas...
O que é uma invariante?

São conceitos que não mudam, como por exemplo nomes de classes, etc.
 
Alternativa errada! Essa não é a definição de uma invariante
Alternativa correta
É uma construção de linguagem, como variáveis e constantes
 
Alternativa correta
É uma regra de negócio que deve sempre ser verdadeira para os objetos serem válidos
 
Alternativa correta! Se um aluno tiver mais do que 2 telefones em nosso sistema, essa regra foi violada, logo, o Aluno estará em um estado inválido. Invariantes nada mais são do que regras de negócio que precisam ser verificadas para garantir sua consistência.

@@03
Protegendo o acesso

[00:00] Vou dar uma passada bem rápida em como eu implementei os testes. Eu fiz primeiro um setUp(), onde eu crio um aluno com o CPF e e-mail falsos, para não precisar me preocupar com o construtor e garantir que isso sempre vai funcionar, independente de qualquer regra.
[00:18] Agora eu tenho aqui três testes. Um para garantir que mais de dois telefones, eu já vou ter uma exceção sendo lançada. Então eu espero que uma exceção do tipo que você criou seja lançada, caso eu tente adicionar três telefones. Eu também estou garantido que ao adicionar um telefone só, esse código da linha 36 está funcionando, e está sendo armazenado, eu tenho um único telefone. E no caso também com dois telefones.

[00:42] Caso eu tivesse, por exemplo, uma invariância onde eu pudesse ter, pelo menos, até 5 telefones, eu não ia criar um teste para cada um desses casos, eu ia criar, como nós já vimos nos treinamentos relacionados a teste, um data provider. Se você não sabe do que eu estou falando, quando finalizar o treinamento corre lá e faz os treinamentos de testes.

[01:05] Mas então, basicamente, eu criei esses testes e seu rodar, só para vocês verem que eu não estou enganando ninguém, os testes passam. Tem um dos testes implementados junto com nossa regra de negócios, vamos falar sobre o que nós fizemos aqui. Isso foi uma invariância. Ou seja, uma regra entre essas duas relações, uma regra de negócios na prática.

[01:27] E quando eu tenho um objeto, uma classe, controlando o acesso às classes relacionadas, como por exemplo, de telefones, nós temos o que é chamado no mundo de DDD de aggregates ou agregados.

[01:42] Um aluno, ele tem vários telefones e ele controla o acesso a esses telefones. Eu não consigo criar um telefone e adicionar no aluno, sem ser pelo método adicionarTelefone(), e somente dentro da classe aluno eu instancio um novo telefone. Eu não deveria vir na minha aplicação, por exemplo, e ao matricular um aluno, eu não deveria fazer $telefone = new Telefone () e adicionar lá.

[02:14] Eu devo sempre criar telefones através do método adicionarTelefone() e isso faz com que aluno seja mais uma vez um agregado ou um aggregate. Então um aggregate é uma classe, uma entidade na prática, é uma entidade que possui objetos relacionados e esses objetos relacionados são controlados por ele.

[02:36] Então dentro de uma relação entre agregados, o aluno é o que pode ser chamado de aggregate root, ou seja, a raiz de agregação. E a partir do aluno, que é a raiz dessa agregação, eu consigo acessar, eu consigo adicionar os objetos relacionados, que no caso são telefones.

[02:57] Então essa invariância, que é a regra de negócios, adicionada a uma entidade, que é aluno, gera um relacionamento de agregados. No caso o aluno é um aggregate root, ou seja, raiz de agregação, e os telefones são seus relacionamentos.

[03:13] É muito comum em livros ou vídeos, em vários materiais, serem explicados como tendo uma semelhança, certa relação, agregados ou aggregate roots, e coleções, ou seja, como se um aluno fosse uma coleção de telefones. Isso conceitualmente é errado. Um aluno não é somente uma coleção de telefones, por exemplo, um exemplo muito utilizado, é que uma turma que é um aggregate pode ter alunos, logo uma turma é uma coleção de alunos.

[03:46] Só que uma turma pode ser muito mais do que só uma coleção de alunos, uma turma tem disciplinas, uma turma tem carga horária, uma turma tem informações referentes a ela própria. Então um aggregate root, ou um aggregate não é só uma coleção. Existe essa diferença muito clara, onde uma coleção nada mais é do que uma lista de dados, um conjunto de dados, onde só os dados individuais possuem informações específicas.

[04:13] Já em um aggregate, o aggregate em si tem informações próprias, e não somente cada item desse aggregate. Então nesse nosso caso, você provavelmente nem cogitou a possibilidade da relação entre um aggregate e uma coleção.

[04:29] Você sabe que um aluno não é uma mera coleção de telefones, mas em alguns exemplos quando você for pesquisar mais sobre aggregates, e eu tenho certeza que você vai pesquisar mais sobre o assunto, você pode acabar vendo explicações que confundem esses dois termos. Então você já sabe que não é muito bem por aí. Aggregate root tem coleções, mas não é uma coleção. Nosso aluno tem uma coleção de telefones, seja uma lista, um array, um conjunto, o que for, mas ele possui uma coleção, e não é uma coleção.

[05:02] Então, recapitulando, o que nós fizemos nesse código na prática foi criar uma raiz de agregação, um aggregate root, onde nosso aluno controla todo o acesso à classe de telefone. Então eu só consigo adicionar um telefone através da classe aluno, eu só consigo recuperar telefones através da classe de aluno e, inclusive, em algumas linguagens existe uma feature, existe uma funcionalidade, onde eu consigo criar classes dentro de outras classes.

[05:32] Então nesses casos, é bastante comum que esse tipo de coisa aconteça, eu criasse uma classe dentro da classe aluno, já que eu sei que um telefone só pode existir dentro de aluno, isso é comum de acontecer. O PHP não permite isso, mas ele permite algo bastante semelhante que é, com o nosso autoloader configurado, adicionar uma outra classe Telefone, e essa classe Telefone não vai estar acessível em nenhum outro lugar diretamente.

[06:02] O nosso autoloader não consegue achar essa classe Telefone, então para eu achar ela eu terei que fazer aquele require, fazer o nosso código um pouquinho mais feio entre aspas. Só que isso não é uma boa prática, isso fere algumas recomendações “PSRs”, então o que normalmente você vai ver sendo feito em PHP?

[06:23] Ter essa raiz de agregação, ter o aggregate root aqui configurado, mas, mesmo assim, a classe de telefone é uma classe a parte, eu conseguiria instanciar um telefone por si só, isso não vai ser proibido explicitamente, mas, na prática, todos os nossos use cases, todos os nossos serviços vão utilizar o método no aggregate root para conseguir manipular os telefones.

[06:48] Por exemplo, se eu quisesse alterar um telefone eu não buscaria os telefones, e aí um item do array eu alteraria diretamente. Caso fosse possível na nossa aplicação alterar telefones, eu teria um método como, por exemplo, alteraNumeroTelefone, eu recebo o $indice, ou seja, a posição na minha coleção, e o $novoNumero e faria algo do tipo.

[07:15] Então nós sempre controlamos todo o acesso as entidades relacionadas aos value objects relacionados a um aggregate root através de métodos do próprio aggregate root. Nada fora desse aggregate root vai alterar os telefones.

[07:31] Então esse é o conceito de aggregate root, esse é o conceito de agregados, você deve estudar mais sobre esse assunto, que é um assunto mais amplo, mas esse é o básico que nós precisamos saber para dar continuidade no treinamento e nos estudos sobre DDD. No próximo vídeo, vamos falar um pouco mais sobre a persistência de aggregate roots, a persistência desses objetos agregados.

@@04
Para saber mais: Aggregates

O termo Aggregate já foi citado em treinamentos anteriores, mas como recordar é viver, deixo aqui um breve artigo do Martin Fowler sobre o assunto: https://martinfowler.com/bliki/DDD_Aggregate.html

@@05
Persistência de aggregates

[00:00] Vamos falar um pouco, e bem pouco mesmo sobre persistência de aggregate roots.
[00:08] O que acontece? Um aluno controla todo o acesso aos telefones, ou seja, sempre que eu salvar um aluno faz sentido que eu salve também todos os telefones. E caso eu precise, caso nosso negócio permita remover um telefone de um aluno, eu teria, por exemplo, um método public function removerTelefone() onde eu receberia o DDD e o número e, para eu salvar, para eu persistir isso no banco de dados, eu precisaria atualizar meu aluno.

[00:40] Eu não iria lá no banco de dados, através de um repositório, eu não acessaria o método deletar telefone, eu não acessaria um repositório de telefones e chamar o método "remover", não. Eu faço todo esse acesso também através de um repositório do aggregate root. Porque, mais uma vez, um aggregate root, a raiz de agregação, controla todo o acesso aos seus objetos relacionados, inclusive quando nós falamos de persistência.

[01:12] Então ao adicionar um aluno no “RepositorioDeAlunoComPdo.php”, eu também preciso adicionar todos os telefones, e aqui entra um detalhe muito importante e esse é um estudo muito mais aprofundado, inclusive vale muito a pena a leitura sobre esses detalhes, só que eu não vou entrar muito aqui nesses detalhes.

[01:30] Mas, basicamente, nós precisamos de algumas formas de garantir que os telefones vão ser inseridos corretamente. Caso algum telefone não seja inserido eu preciso cancelar a inserção dos alunos, e você provavelmente está pensando: “Vinicius, é só utilizar transações”. E sim, 90% das vezes utilizar uma transação resolve o problema, então basta que essa conexão que nós estamos recebendo esteja com uma transação aberta para que esse método já funcione.

[02:00] Só que existem casos complexos, porque uma raiz de agregação pode conter muito mais invariantes, nós às vezes podemos acabar precisando garantir invariantes no mecanismo de persistência. Então esses detalhes mais complexos, não vale a pena abordar nesse curso, senão isso se tornaria um treinamento de banco de dados. Porque aqui nós entramos em estratégias otimistas ou pessimistas de travamento de tabelas, esse tipo de detalhe muito específico de cada mecanismo de persistência.

[02:31] Mas a leitura e a pesquisa desses detalhes são muito importantes, então eu recomendo muito que você estude, seja qual for o mecanismo de persistência utilizado, como você pode tratar a consistência dos dados. Por exemplo, ao atualizar um aluno para garantir que todos os telefones foram atualizados também, existe uma estratégia de persistência e de consistência que consiste em adicionar uma coluna no banco de dados que armazena a versão.

[03:00] E cada vez que atualizar um aggregate root, eu preciso reinserir os telefones ou atualizá-los também para ter a versão batendo. Então esse estudo é muito interessante, mas foge do foco desse treinamento, que é específico sobre DDD com PHP. Mas eu não poderia deixar de falar aqui, é responsabilidade do repositório do aggregate root persistir os seus objetos relacionados também.

[03:27] E obviamente nós poderíamos ter, por exemplo, um repositório de telefone. Onde ao invés de fazermos esses SQL aqui nós chamaríamos o método desse repositório. Mas de qualquer forma nos nossos applications services, nós só chamaríamos o repositório de aluno.

[03:48] Então com esses conceitos em mente, você pode reparar que no estudo de arquitetura, já implementamos boa parte do que o DDD sugere. O que falta, são detalhes. Por exemplo, esses detalhes mais complexos de persistência. E aí o estudo de banco de dados seria necessário, nós precisaríamos acabar escolhendo um mecanismo específico para implementar no código. Mas nós já implementamos boa parte.

[04:13] Se recebermos uma conexão como uma transação aberta, 90% dos problemas já foram resolvidos pelo simples fato de nós termos estudado bem sobre arquitetura.

[04:23] Então repara como esses dois temas se conversam o tempo todo. Se nós estudamos muito DDD, naturalmente vamos estudar muito sobre a arquitetura. Se estudamos muito sobre arquitetura, em algum momento vamos acabar estudando sobre DDD. Então essa que é a beleza do estudo da arquitetura de software, muitos conteúdos, muitos estudos, se completam.

[04:45] Então nós vimos mais um caso, onde o simples fato de nós termos estudado arquitetura e implementado padrões arquiteturais, já entregaram para nós detalhes de consistência. É muito fácil manter esse método, e nossa raiz de agregação consistente, no nosso caso.

[05:00] Então mais uma vez, recapitulando, uma raiz de agregação deve controlar o acesso aos objetos relacionados, então eu só consigo acessar telefones através da classe aluno.

[05:14] Uma invariância é uma regra, que deve sempre ser verdadeira, então preciso validar sempre que eu adicionar um telefone, que eu não vou ter mais de dois. E uma entidade que possui invariâncias nos seus relacionamentos, vira uma raiz de agregação. E se é uma raiz de agregação, a persistência também precisa ser feita de um ponto central. A raiz de agregação que tem seu repositório, vai cuidar da persistência dos objetos relacionados.

[05:43] Com isso em mente, fica mais uma vez a sugestão de leitura sobre mecanismo de consistência os mecanismos de persistência, ou seja, como garantir a consistência dos dados utilizando SQL. Seja com transações, com mecanismos pessimistas ou otimistas de consistência, com lock de tabela, conversionamento no banco. Com essas técnicas vale a pena a leitura sobre isso.

[06:09] E agora que nós já entendemos essa parte mais complexa, porque embora eu esteja passando o superficial, o básico, para nós entendermos o conceito, existe muito estudo por trás, e só a leitura, aquelas literaturas mais clássicas vão trazer esse conhecimento para nós. Obviamente, no final do treinamento eu vou deixar algumas referências, mas o básico que nós precisamos entender por enquanto é isso.

[06:33] Agora vamos falar um pouco sobre um outro bloco de construção muito importante do DDD, uma outra técnica muito utilizada para continuarmos tratando nosso domínio da aplicação como ponto central, o domínio do nosso software como ponto central. Então vamos conversar no próximo capítulo sobre eventos.

@@06
Para saber mais: Relacionamentos

Até aqui nós fizemos alguns relacionamentos entre agregados, porém existe uma regra interessante a ser seguida nesses casos.
Quando vamos relacionar 2 aggregates, não devemos ter a instância deles se relacionando, mas sim apenas as suas identidades. Nesta discussão aqui no fórum esse ponto foi levantado: https://cursos.alura.com.br/forum/topico-referencias-em-agregados-149004

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Conhecemos o conceito de Aggregates;
Entendemos o que é uma invariante;
Vimos que persistência de Aggregates é um assunto complexo;
Há detalhes de consistência;
Optimist e Pessimist locking são conceitos mais avançados sobre o assunto;

##### 20/02/2024

@03-Evento de domínio

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

https://caelum-online-public.s3.amazonaws.com/1822-DDD-PHP/02/DDD-PHP-projeto-aula-2-completo.zip

@@02
Eventos de domínio

[00:00] Boas-vindas de volta a mais um capítulo desse treinamento de introdução aos conceitos de DDD utilizando PHP. E nós já vimos vários blocos de construção, vários dos padrões táticos do DDD, as entidades, os value objects, etc. E agora está na hora de nós vermos um bloco de construção que é um dos mais importantes do design orientado ao domínio, do DDD, que é a parte de eventos. Então antes de tudo vamos definir o que é um evento.
[00:30] Nós que somos desenvolvedores PHP não estamos tão habituados, por padrão, a trabalhar com eventos, mas se você já trabalha com JavaScript, por exemplo, você sabe que um evento é algo que acontece e nós por algum motivo estamos interessados nele.

[00:44] Por exemplo, quando o usuário clica em um botão, é disparado um evento de click. Quando um usuário passa o mouse em cima de algum, lugar é disparado um efeito de mouse over. Então eventos são algo que acontece e alguém precisa ser notificado daquilo. Então um evento de domínio é algo que acontece no domínio da nossa aplicação e que alguém vai precisar ser notificado disso. Basicamente é isso.

[01:11] Então pensando de forma bem rápida, que evento no nosso domínio pode acontecer, o que nós podemos ter aqui?

[01:18] Já está aberto, e foi honestamente por acaso, um caso de uso aqui chamado “MatricularAluno”. Quando um aluno é matriculado acontece exatamente isso que eu acabei de falar, aluno matriculado. Então nós já temos esse evento modelado na nossa mente. Eu sei que ao executar esse caso de uso, eu vou ter um evento acontecendo, que é o evento do aluno matriculado.

[01:43] Então vamos colocar isso na prática, vamos criar essa classe que representa um evento. E já que é um evento de domínio, ele vai ficar na nossa camada de domínio. Como ele está relacionado ao aluno, ele vai ficar no nosso módulo de aluno.

[01:56] Então vamos nessa, “New > PHP Class > Name: AlunoMatriculado”. Existem algumas opções e algumas regras para criarmos os nomes dos nossos domínios. Por padrão, e faz todo sentido, isso deve representar uma ação e não, por exemplo, matricular aluno também. Não é para representar algo que nós vamos fazer, mas sim algo que aconteceu.

[02:28] Então nós podemos representar dessa forma, como “AlunoMatriculado”, ou utilizar o passado, como “AlunoFoiMatriculado”. Isso deixa ainda mais claro que isso é um evento, só que é um pouco mais incomum você encontrar esse tipo de nomenclatura. Eu, Vinicius, uma opinião pessoal, eu acho que da segunda forma fica mais legível.

[02:51] Mas como nós encontramos com menos frequência, eu vou utilizar o que nós vemos com maior frequência que é “AlunoMatriculado”, “UsuárioCriado”, “PedidoFeito”, esse tipo de coisa. Então essa é a forma mais comum de nomearmos evento de domínio. Deixa eu fechar isso aqui.

[03:10] O que um evento de domínio precisa ter? Eu preciso ter alguma informação para encontrar o aluno, para eu saber qual aluno foi matriculado. Eu também preciso ter, e isso é para qualquer evento, eu preciso saber quando esse evento aconteceu. Se eu preciso saber sempre essa informação sobre o domínio, vamos inclusive criar, por enquanto, vamos tratar mais sobre esse assunto depois, mas por enquanto aqui na raiz de domínio, vamos chamar de "Evento".

[03:37] “New > File > PHP Class > Name: Evento”. Vou criar essa interface, onde nós vamos precisar sempre informar o momento em que aconteceu esse evento. E isso vai ser um DateTimeImmutable(), eu vou forçar que isso deve ser sempre imutável. Porque, e aí vamos recapitular o que nós já vimos sobre eventos.

[04:01] Um evento é algo que aconteceu, então ele tem que estar no passado, aluno foi matriculado, ou aluno matriculado, pedido feito, esse tipo de coisa. Um evento possui um momento em que ele aconteceu. Então nós já definimos nessa interface que nós vamos implementar. E um evento de domínio deve ser imutável, o que isso quer dizer? A partir do momento que eu crio um objeto utilizando a classe AlunoMatriculado, nenhum dos seus valores pode ser alterado.

[04:32] Ele só pode receber valores, informar esses valores, mas nunca será alterado. Então essa classe também vai ser imutável. E por isso eu estou deixando a data como algo imutável. Então vamos nessa, vamos implementar todos esses conceitos.

[04:48] Eu sei que meu AlunoMatriculado é um evento e eu preciso informar o momento desse evento. Então vamos lá, no nosso construtor, ou seja, assim que nós criarmos esse evento AlunoMatriculado, o momento vai ser o momento atual, o date time atual. Vamos criar então DateTimeImmutable $momento. Criei essa propriedade, no construtor eu estou inicializando ela, então no nosso método eu simplesmente retorno.

[05:24] Recapitulando mais uma vez, para tudo ficar muito claro, eu sei que todo evento acontece em algum momento, então eu preciso fornecer esse momento para quem precisar. Então sempre que eu criar esse evento, ou seja, no construtor. Eu vou definir que o momento é o momento atual utilizando o DateTimeImmutable()

[05:43] Só que o evento de AlunoMatriculado precisa de alguma informação que me permita identificar esse aluno, que me permita encontrar esse aluno, seja como for. E qual é a identificação de um aluno, como eu consigo identificar um aluno? Através de um CPF. Então sempre que eu criar um evento do tipo AlunoMatriculado, eu vou receber o CPF do aluno. Então vamos inicializar isso daqui.

[06:13] Se eu tenho esse dado chegando, eu preciso fornecer ele de alguma forma. Então vamos lá, public function cpfAluno(): Cpf. Eu vou fornecer esse dado. “Vinicius, por que você não recebe o aluno como um todo?” Porque dessa forma, eu vou estar quebrando o encapsulamento do meu domínio, eu posso acabar fornecendo para alguém que não está no meu domínio de aluno, seja lá um domínio de financeiro, ou algo do tipo, informações que eles não precisam.

[06:40] Então eu vou permitir que essa classe nova que vai ouvir esse evento de AlunoMatriculado, eu vou acabar permitindo que essa classe adicione telefone, que essa classe faça manipulações que ela não precisa fazer. Então tudo que eu preciso informar é uma forma de ela encontrar esse aluno. Então vamos lá fornecer o CPF do aluno.

[07:03] Com isso, já temos a definição do nosso evento de domínio. Eu consigo fazer com que eu represente o evento de que um aluno foi matriculado, o evento AlunoMatriculado. A partir desse evento eu sei quando ele aconteceu, e eu sei qual é o CPF do aluno que foi matriculado. Então já tenho todas as informações necessárias para esse evento de domínio fazer sentido.

[07:32] Só que por enquanto ele é inútil. Eu ainda não tenho nada sendo feito com ele, então vamos ver como que nós podemos fazer para, por exemplo, reagir a esse evento, como nós podemos fazer para lançar, para emitir esse evento, para fazer com que esse evento aconteça, vamos implementar a parte prática de um evento de domínio.

@@03
Motivação

Sabemos o que é um evento e aprendemos o que é um evento de domínio.
Qual a motivação para termos eventos de domínio em nossa aplicação?

Poder programar nossa aplicação para reagir a eventos de forma flexível
 
Alternativa correta! Trabalhando com eventos, o mesmo evento pode gerar várias ações, o que nos dá muita flexibilidade
Alternativa correta
Poder nos lembrar como é programar com JS onde há eventos do DOM
 
Alternativa correta
Aplicar design patterns se torna muito mais fácil utilizando eventos de domínio

@@04
Reagindo a eventos

[00:00] Vamos começar a implementar a reação a esse evento, vamos implementar uma classe que vai ouvir o evento AlunoMatriculado e vai reagir a ele.
[00:15] Então vamos nessa, o que nós precisamos. Vamos criar aqui esse ouvinte “Aluno > New > PHP Class > Name: LogDeAlunoMatriculado”. Sempre que acontecer esse evento, essa classe vai reagir ao evento AlunoMatriculado e realizar um log.

[00:33] Então vamos lá, como essa classe reage ao evento AlunoMatriculado, exatamente esse vai ser o nome do meu método. Já tenho o método criado, reageAo(AlunoMatriculado $alunoMatriculado) : void. Esse é o evento que esse ouvinte de evento, vamos chamar assim, vai reagir.

[00:57] Então o que eu vou fazer? Eu só vou jogar na saída padrão, ou seja, eu vou exibir no terminal uma mensagem. Então fprintf(), o que isso faz? Escreve em algum arquivo, e esse arquivo vai ser a saída padrão do sistema, que é o terminal.

[01:19] Eu estou mandando para saída de erro só para vocês terem familiaridade com esse conceito, e vale a pena estudar sobre saída padrão, entrada de dados, isso são conceitos de sistema operacional, então acho que vale a pena nós citarmos isso. Mas na prática, isso tudo que eu vou fazer é mesma coisa do que fazer um echo.

[01:39] Então vamos lá, eu vou formatar uma string, e eu vou dizer que Aluno com CPF %s foi matriculado na data %s sendo %s uma string qualquer. Agora vamos passar essa string aqui, vai ser (string) $salunoMatriculado -> cpfAluno(). E essa segunda string vai ser a data formatada, então $alunoMatriculado->momento()->format: (‘d/m/y’).

[02:13] Vamos recapitular o que eu estou fazendo, na prática, eu tenho uma classe que vai realizar o LogDeAlunoMatriculado, e ela reage ao evento AlunoMatriculado. Quando ela reagir ao evento AlunoMatriculado, ela vai exibir na saída de erro, ou seja, no terminal, essa seguinte mensagem: “Aluno com CPF tal foi matriculado na data tal”. E o CPF tal, vai ser o CPF do aluno matriculado. A data vai ser o momento em que aconteceu o evento aluno matriculado.

[02:46] Então nós já temos, de forma bastante simples, a implementação desse ouvinte. E nós vamos ver agora, nós precisamos entender, como que fazemos para emitir esse evento, para publicar esse evento. E para deixar essa parte de publicação de eventos e de ouvir eventos um pouco mais genérica, nós vamos precisar fazer algumas modificações pequenas no código, mas vamos ver sobre isso no próximo vídeo.

@@05
Publicando eventos

[00:00] Agora vamos implementar, como nós podemos emitir esse evento, como que nós podemos publicar o evento AlunoMatriculado.
[00:10] Então vamos de novo no nosso domínio, começar a pensar na classe publicador de eventos. “Domínio > New > PHP Class >Name: PublicadorDeEvento”. O que essa classe vai fazer? Nessa classe eu consigo adicionar ouvintes, faz todo sentido. public function adicionarOuvinte(), e eu preciso informar quais são os ouvintes.

[00:34] Vamos com calma, vai ser um array $ouvintes, que vai iniciar vazio, e ao adicionar um ouvinte, não vou informar o tipo ainda, eu vou sempre adicionar ao meu array de ouvintes, esse $ouvinte.

[00:50] Ou seja, eu posso ter vários ouvintes de evento, inclusive vários ouvintes para o mesmo evento, então sempre que eu quiser informar que eu tenho um ouvinte para determinador evento, eu adiciono ele utilizando esse método aqui.

[01:04] E agora, para publicar, posso criar o método publicar(), e o que eu vou publicar? Um evento. Vou publicar um evento e para cada um dos nossos ouvintes, como foreach ($this => ouvintes as $ouvintes), eu vou fazer o quê? “Ouvinte, processa esse evento”. $ouvinte->processa(evento).

[01:31] Agora vamos para a parte realmente prática, eu consigo publicar esse evento, mas qual o tipo desse ouvinte? Vai ser sempre esse LogDeAlunoMatriculado? Não! Então eu preciso de um tipo mais abstrato, que saiba processar um evento. E além disso, eu preciso saber se eu vou querer ou não ouvir o evento que está sendo publicado.

[01:52] Porque, por exemplo, imagina que eu publique o evento alunoIndicado, esse ouvinte aqui não precisa responder esse evento, não precisa reagir. Então nós precisamos desse tipo de informação também.

[02:05] Então vamos lá, criar no domínio mais uma classe, “Domínio > New > PHP Class > Name: OuvinteDeEvento”, essa classe OuvinteDeEvento, vai ser uma classe abstrata, que vai ter o método public function processa(Evento $evento). Vai processar um evento onde, if ($this => sabeProcessar($evento)) caso essa classe saiba processar esse evento, então ela vai reagir ao evento $this => reageAo$evento).

[02:45] Só que esses dois métodos não existem, então vamos criar. abstract public function sabeProcessar, que vai retornar um bool e recebe um $evento. E temos também o reageAo(Evento $evento), que não retorna nada.

[03:16] Temos esses métodos, então eu sei que o nosso PublicadorDeEvento vai receber sempre OuvinteDeEvento e para cada um dos ouvintes, ele vai chamar esse método processa. Então o método processa pergunta se o se o ouvinte atual sabe processar o evento e se souber, reage.

[03:38] Então aqui no nosso LogDeAlunoMatriculado, nós precisamos estender o OuvinteDeEvento, implementar os métodos necessários, o sabeProcessar. Como que eu identifico se o ouvinte sabe processar um evento? É só eu verificar se esse evento é do tipo, ou seja, a instância dele é de AlunoMatriculado. Caso seja, ele sabe processar.

[04:04] Eu não posso receber direto AlunoMatriculado, porque um OuvinteDeEvento recebe um evento qualquer. Então eu preciso mudar para evento, só que nem todo evento tem CPF do aluno. Então nós vamos fazer com que um $alunoMatriculado receba, nós poderíamos fazer um typecast, ou eu posso simplesmente informar, que esse evento é do tipo AlunoMatriculado sempre.

[04:33] Porque eu sei que esse método só vai ser chamado quando eu tiver um AlunoMatriculado, então eu estou informando que método sempre recebe esse evento AlunoMatriculado, um evento deste tipo.

[04:43] Então agora vamos recapitular tudo que nós fizemos, nós criamos um publicador de eventos, esse publicador de eventos, recebe vários ouvintes eu posso adicionar quantos ouvintes eu quiser, e eu publico algum evento, também não retorna nada, posso publicar algum evento. Quando eu publicar, ele vai percorrer toda a lista de ouvintes e chamar o método processa, inclusive deixa eu adicionar o tipo para o “phpstorm” me ajudar, OuvinteDeEvento.

[05:12] Então o nosso método processa, faz o quê, pergunta: “Olha, eu sei processar esse evento? Essa classe sabe processar esse evento? Se souber, reage a ele.” Então no nosso LogDeAlunoMatriculado, o que nós estamos fazendo, ele sabe processar um evento, caso a instância dele seja AlunoMatriculado. Então se for, nós podemos reagir a esse evento que vai simplesmente fazer um log.

[05:36] Então com isso tudo configurado, o que nós vamos fazer, nós vamos configurar um publicador de eventos, então $this->publicador = new PublicadorDeEvento(), isso tudo na nossa camada de aplicação, o nosso MatricularAluno vai fazer isso por enquanto. E nesse publicador o que eu vou fazer, eu vou adicionar um ouvinte, que é um new LogDeAlunoMatriculado.

[06:03] Então vamos adicionar esse atributo. Temos aqui um publicador de evento. Então sempre que executar o MatricularAluno, etc, eu vou no meu publicador, publicar um novo evento, que é AlunoMatriculado. E esse AlunoMatriculado, eu sei que ele tem esse cpfAluno. Só que aqui entrou um problema. Eu não posso pegar essa string, então vou pegar o CPF do aluno.

[06:34] Só que entra aqui um detalhe, que o CPF do aluno está sendo devolvido como string, e eu preciso do CPF em si. Então vou passar a devolver esse CPF. Então vamos voltar no nosso use case. E estou publicando o evento AlunoMatriculado. Deixa eu separar essa linha 28 para ficar um pouco mais legível.

[07:00] Recapitulando mais uma vez, porque eu sei que isso é um assunto um pouco denso, deixa até fechar a barra lateral. Sempre que eu executar a ação de matricular um aluno, eu vou configurar que o meu PublicadorDeEvento vai ter esse ouvinte da linha 28, de LogDeAlunoMatriculado, e quando eu terminar de adicionar esse aluno, ou seja, matriculei ele, eu vou publicar esse evento.

[07:22] Então quando eu executar esse MatricularAluno, eu sei que aquele log vai acontecer. Mas provavelmente você está se perguntando: “Vinícius que trabalheira, eu poderia copiar essa linha aqui e colar no meu MatricularAluno.php, sem criar esse monte de classe.”

[07:39] Pois é, só que eu vou deixar bem claro alguns detalhes. Quando você for criar uma aplicação dessa para o mundo real, você não vai configurar o PublicadorDeEvento em cada um dos seus use cases, em cada um dos application services. Você vai usar, como nós vimos no treinamento de MVC, você vai usar um container de injeção de dependência.

[07:58] Então ao invés de criar o PublicadorDeEvento, nós vamos receber um PublicadorDeEvento todo configurado, com todos os ouvintes necessários. Então nós só inicializamos ele, $publicador, e com esse PublicadorDeEvento todo configurado, nós só publicamos o evento.

[08:20] Nós não precisamos saber o que vai acontecer, se vai um log do aluno matriculado, se esse evento vai ser salvo no banco de dados, se isso vai gerar uma requisição para uma nova API que vai informar que um aluno foi matriculado numa aplicação diferente.

[08:36] Então nós não precisamos saber disso, no nosso container de injeção de dependência nós podemos configurar isso, se nós estamos utilizando algum framework, nas configurações do framework, nós podemos informar esse tipo de detalhe. Então nós ganhamos, e muito, em flexibilidade. E além de ganhar em flexibilidade para o próprio sistema, nós conseguimos facilitar a comunicação entre sistemas diferentes.

[09:01] Eu posso simplesmente emitir um evento, e esse evento vai ter algum ouvinte que faz uma requisição para outro sistema, de forma muito simples, de forma muito facilitada. Então vamos inclusive ver se isso tudo está funcionando por enquanto aqui com esse nosso matricular-aluno.php.

[09:18] Vamos reescrever ele, para não chamar diretamente, para chamar aquele nosso MatricularAluno, que é aquele use case de MatricularAluno. Vamos fazer esse comando funcionar agora.

[09:32] Ele recebe um repositório de aluno, RepositorioDeAlunoEmMemoria então vai ser um repositório em memória. Ele recebe também um publicador, e vamos lá criar esse $publicador, de novo, isso seria feito no container de injeção de dependência, eu vou fazer direto nesse arquivo de teste mesmo por brevidade, para ficar tudo mais rápido.

[09:52] Então esse publicador vai ter um novo ouvinte, que é o LogDeAlunoMatriculado , importei. Agora esse $useCase, eu posso executar com os dados Dto, MatricularAlunoDto. Eu vou ter o $cpf do aluno, o $nome do aluno, e o $email do aluno. Ponto, vou executar, e teoricamente eu preciso receber uma mensagem escrita “Aluno com CPF tal, foi matriculado na data, dia 23 de Maio.”

[10:34] Então vamos executar isso aqui, php matricular-aluno.php, e aqui o CPF, “123.456.789-10”, o nome que é Vinícius Dias, e o e-mail que é um meio de exemplo qualquer, e pronto. “Aluno com CPF, CPF que eu digitei, foi matriculado na data tal”. Então nós ganhamos uma inflexibilidade que, caso eu queira, que ao matricular um aluno esse evento seja enviado para uma nova API, eu crio uma classe nova, e adiciono como ouvinte.

[11:09] Então eu não preciso editando o código existente, e isso entra naqueles conceitos que nós já trabalhamos bastante sobre solid. Então repara que esse curso, por ser um curso mais avançado, tem vários requisitos, como os requisitos de arquitetura, dos cursos de MVC, dos cursos de solid, então nós precisamos ter os conceitos de orientação objetos muito bem claro na nossa cabeça, para conseguir aplicar tudo isso corretamente.

[11:38] Então vamos mais uma vez, eu sei que essa aula foi densa, então vamos recapitular o que nós fizemos. Um domínio possui eventos, coisas que acontecem no domínio, como, por exemplo, um aluno matriculado. Esse aluno matriculado, esse evento tem a informação para eu conseguir identificar esse aluno e quando isso aconteceu. Definimos o que é um domínio. Nós vimos como reagir a esse evento.

[12:04] Então para identificar se eu sei ou não processar determinado evento, eu identifico o tipo dele, então eu estou informando que sim, eu sei processar esse evento, então eu vou reagir a ele exibindo uma mensagem, nada além disso.

[12:16] Só que para publicar esse evento, nós precisamos, cadê o nosso publicador, nós precisamos ter ouvintes, e para cada um desses ouvintes, quando nós publicarmos, nós vamos pedir para ele processar o evento. Então foi exatamente isso que nós fizemos, e nós configuramos um PublicadorDeEvento.

[12:34] Mais uma vez, em uma aplicação real, você teria em um ponto só da aplicação, em um ponto central, como, por exemplo, o container de injeção de dependências e teria com vários ouvintes, vários. Um ouvinte para fazer log de eventos, um ouvinte para persistir eventos, um ouvinte que vai executar ações específicas, como, por exemplo, enviar um e-mail quando aluno foi matriculado, enviar um e-mail quando o aluno for indicado, esse tipo de coisa.

[13:02] Então essas configurações vão ser feitas utilizando um container de injeção de dependência ou utilizando o framework que você estiver utilizando, mas o conceito não muda. E aí o nosso $useCase só vai precisar receber esse publicador já configurado, e vai publicar o evento.

[13:19] Mais uma vez, como tudo que nós fizemos até aqui, existem outras estratégias para você trabalhar com eventos, para você publicar eventos, existem diversas estratégias. Cada estratégia tem seus prós e contras, e essa é uma das estratégias possíveis.

[13:35] Como tudo o que eu vou falar nesse treinamento, vale muito a pena uma leitura mais aprofundada do que são eventos de domínio, como persistir, como tratar eles. Mas aqui, nós já vimos de forma bem prática como reagir e como publicar eventos.

@@06
Para saber mais: Ferramentas

Se você possui familiaridade com algum framework web moderno (como Symfony, Laravel, etc) sabe que eles trabalham com eventos.
Os eventos que os frameworks emitem por padrão não são eventos de domínio, porém nada nos impede de utilizar suas ferramentas a nosso favor para emitir nossos eventos de domínio.

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Definimos o que é um evento;
Entendemos o que é um evento de domínio;
Aprendemos a implementar, emitir e reagir a um evento de domínio;