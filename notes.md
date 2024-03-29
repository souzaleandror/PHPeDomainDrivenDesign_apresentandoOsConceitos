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

#### 21/02/2024

@04-Contextos delimitados

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

https://caelum-online-public.s3.amazonaws.com/1822-DDD-PHP/02/DDD-PHP-projeto-aula-3-completo.zip

@@02
Implementando a gamificação

[00:00] Boas-vindas de volta a mais um capítulo desse treinamento de introdução aos conceitos de DDD utilizando PHP. E agora nós vamos entrar em um capítulo que é bastante difícil, então vou tentar simplificar ao máximo.
[00:13] Antes de falar de qualquer conceito, vamos falar o que eu quero implementar. Eu tenho indicações de alunos, eu tenho alunos se matriculando, então eu quero adicionar, para incentivar, para melhorar o meu negócio, eu quero implementar um conceito de gamificação, parecido com o que nós temos aqui na Alura.

[00:30] Sempre que você responde dúvidas no fórum, você ganha alguns pontos. Quando você finaliza um curso, você ganha pontos. Então quero implementar alguma coisa desse tipo. Eu quero que, por exemplo, quando um aluno se matricular, ele receba um selo. Esse selo vai ter um nome, vai ter uma imagem, esse tipo de coisa.

[00:48] Então vou implementar aqui, vou criar um novo módulo chamado "selo" ou "gamificação", por enquanto eu vou chamar de "selo". “Domínio > New > Directory > Name: Selo”. E vamos implementar essa classe “Selo > New > PHP Class > Name: Selo”, a entidade Selo. Ela vai ter o CPF do aluno, private Cpf $cpfAluno que vai receber esse selo, esse selo, o nome desse selo, pode ser um nome qualquer, e nós podemos ter uma imagem alguma coisa do tipo, mas por enquanto só o CPF do aluno e o nome.

[01:24] Então por exemplo, o aluno pode ter o selo novo aluno, um selo iniciante, um selo novato, alguma coisa do tipo. Quando ele responder mais de 10 perguntas no fórum ele pode receber o selo, não sei, altruísta, pessoa que quer ajudar, algo do tipo. Quando ele indicar um aluno ele pode receber o selo de mão amiga, alguma coisa desse tipo, para incentivar que os alunos vão interagindo com a plataforma.

[01:52] Então vamos criar o nosso construtor, deixa eu utilizar aquela ferramenta do “phpStorm”, que é a out insert, construtor recebendo os dois. Então recebi o CPF, recebi o nome, posso retornar os dois, cpfAluno aluno que retorna um CPF, e retornar o nome do selo. public function __toString() : string que vai retornar o nome do selo.

[02:22] Então nós já temos o selo sendo representado como string, fica aí o desafio para você implementar aqueles testes, que nós já estamos acostumados, esse tipo de coisa.

[02:31] Então nós temos agora um novo contexto da nossa aplicação, inclusive isso poderia até ser uma nova aplicação, uma aplicação diferente, porque tudo que eu preciso saber do aluno para gerar um selo para ele, é do CPF. Então poderia receber esse CPF, e a partir disso ter nossas regras. Nós conseguiríamos armazenar as regras de negócio aqui, dessa aplicação de forma separada, ou pelo menos, mesmo que seja na mesma aplicação, começar a separar esses contextos.

[03:02] Porque, o que acontece? A parte de gamificação não precisa saber que um aluno tem que ter dois telefones ou não, não precisa conhecer todos esses detalhes do mesmo contexto, porque está tudo no domínio da mesma aplicação. Ela não precisa saber telefone de aluno, saber que existe a possibilidade de um aluno não ser encontrado, ele não precisa de todos esses detalhes.

[03:27] Então o que nós podemos fazer, nós podemos começar a separar esses dois contextos. O contexto acadêmico, onde nós temos aluno, a indicação dos alunos, esse tipo de coisa. E o contexto de gamificação, onde nós vamos ter selos, o repositório de cada um dos selos, esse tipo de coisa. Então vamos começar a separar de uma forma diferente esses contextos, e colocar algumas barreiras, delimitar esses dois contextos. Vamos começar a implementar isso no próximo vídeo.

@@03
Separando os contextos

[00:00] Eu implementei aqui, tem uma interface que adiciona um selo e busca os selos de aluno com o CPF informado. E implementei um repositório de selo em memória, só para nós termos o repositório implementado, que foi o desafio que eu deixei para vocês. Vamos começar a separar esses contextos.
[00:23] Porque, de novo, eu não preciso que o meu contexto de gamificação, não preciso que o meu módulo de gamificação, saiba tudo sobre como funciona a indicação entre um aluno e o outro, ele não precisa ter as informações de cifra de senha do aluno, de LogDeAlunoMatriculado, sobre os telefones, ele não precisa ter acesso a isso tudo.

[00:43] Então nós conseguimos separar, para evoluir esses dois contextos de forma separada. Então nós podemos ter esse contexto acadêmico, que tem aluno, que tem indicação do aluno etc., você pode até pensar em um nome melhor para isso. E nós podemos ter o contexto de gamificação, ou jogatina caso você prefira.

[01:05] Vamos separar esses dois contextos por pastas. Então eu vou ter o contexto acadêmico, lá na raiz do “src”, e o contexto de gamificação. Então eu vou passar tudo que eu tenho por enquanto, para o meu contexto acadêmico e nós vamos ter que alterar todos aqueles namespaces, isso vai dar bastante trabalho.

[01:26] E eu vou ter aqueles nossos “app”, ou application , nós estamos usando application. “App > Refactor > Rename > Aplicacao ” . Nós estamos usando o domínio, “Gamificacao > New > Directory > Dominio”, e um novo diretório chamado infra. Temos aqueles conceitos aqui.

[01:58] E vamos pegar o domínio do selo, que nós já temos, e trazer para o domínio da nossa gamificação. Então eu posso até apagar os selos. Vou trazer também infraestrutura do selo, eu posso tirar de “infra” e adicionar em “gamificacao > infra”.

[02:20] Então nós temos a infraestrutura do selo, que é o repositório e tem o domínio do selo, que é o selo em si e o repositório. Eu vou deixar para alterar todos namespaces depois. Então vamos lá, deixa eu fechar aqui. Então primeiro aqui em selo, eu não estarei mais em domínio direto. Eu vou estar em Gamificacao\Domínio\Selo.

[02:50] Mesma coisa em RepositorioDeSelo.php, então, Gamificacao\Dominio\Selo. E no nosso RepositorioDoSeloEmMemoria, vai estar em “Arquitetura\Gamificacao\Infra\Selo”. E agora nós começamos a ter alguns problemas, deixou tirar isso auqi para importar de novo, só para importar no lugar certo. E agora nós temos um problema.

[03:17] Nós temos dois contextos muito bem separados, temos o contexto acadêmico e o contexto de gamificação, onde cada um pode ser uma aplicação totalmente diferente, que tem aplicação, domínio, infraestrutura, podem evoluir de forma independente.

[03:33] Só que aqui, nós temos bem claramente uma dependência, onde nosso contexto de gamificação está dependendo de algo do nosso contexto acadêmico, inclusive reparar que nosso namespace está errado, eu já vou corrigir. Mas então nós temos uma dependência muito clara e isso é um problema. Por quê? Vamos com bastante calma nessa parte.

[03:57] Nós temos dois contextos que deveriam estar delimitados. Por que eles deveriam estar delimitados? Por que nós deveríamos ter certas barreiras? Porque nesse momento eu estou implementando esses contextos delimitados dentro de um mesmo projeto, só com pastas de separados e namespaces separados.

[04:16] Só que isso pode, no futuro, e normalmente até acontece, evoluir para ser uma aplicação totalmente diferente. Como, por exemplo, pegar esse projeto de Gamificacao e separar em um componente diferente, de forma que eu possa fazer com composer, um ComposerRequireGamificacao, igual nós já aprendemos no curso de composer. Ou seja, separar em um projeto diferente.

[04:40] Então se eu tenho essa dependência, eu tenho um problema muito grande. Eu não consigo isolar o meu contexto de gamificação, eu não consigo fazer com que ele seja um projeto independente. Então nós vamos começar a estudar como isolar, na prática, cada um dos contextos e como fazer com que cada um dos contextos possa comunicar entre si, sem violar esse tipo de regra.

[05:04] Só que antes disso, vamos entender uma ferramenta, um dos padrões estratégicos do DDD, que é o mapa de contextos. Para nós conseguirmos visualizar, para nós conseguirmos enxergar o que faz parte de cada um dos contextos, e como eles vão se comunicar.

[05:18] Só que isso nós vamos fazer no próximo vídeo. E entre um vídeo e outro, eu vou corrigir todos esses namespaces. Então deixa como desafio também, que é um desafio meio chato, mas nós vamos fazer, de corrigir todos os todos os namespaces do contexto acadêmico. Então te vejo no próximo vídeo.

@@04
Motivação

Entendemos como separar contextos em nossa aplicação para isolá-los, mas...
Qual a vantagem de separar nossa aplicação em contextos delimitados (Bounded Contexts)?

Segurança
 
Alternativa correta
Performance
 
Alternativa correta
Flexibilidade
 
Alternativa correta! Com contextos bem delimitados, podemos ter equipes separadas para trabalhar em cada um dos contextos e além disso eles podem até virar projetos separados, evoluindo individualmente.

@@05
Mapas de contexto

[00:00] Vamos conversar um pouco sobre mapa de contexto, ou context map.
[00:08] O mapa de contexto é uma ferramenta, um padrão estratégico do DDD onde nós definimos de forma visual como que os contextos se separam, e como eles se comunicam entre si.

[00:18] Então eu peguei um exemplo da Internet qualquer, e isso deixa bem claro que a linguagem ubíqua deve ser utilizada, inclusive para mapear os contextos, ou seja, os profissionais de domínio, os experts de domínio, de negócios, os profissionais de negócio, devem saber que existe um contexto acadêmico, um contexto de Gamificação e eles sabem conversar sobre esse assunto, e sabem como cada um desses contextos se conversam.

[00:47] Então nesse exemplo dado na figura, existe um contexto genérico, um subdomínio genérico, que não está na aplicação, no núcleo desse programa, que é sobre CRM. E esse CRM se comunica de alguma forma com o contexto de pedidos. O contexto de pedidos tem uma camada compartilhada com contexto de produtos.

[01:10] O contexto de entrega precisa inclusive de uma camada que nós vamos conversar lá para frente, para se comunicar com o de pedidos também, de entrega se comunica com o de pedidos. Então existe esse desenho, que pode ser feito de forma bem menos interessante do que essa aqui, de forma bem menos profissional, vamos chamar assim.

[01:30] Então vamos criar um mapa de contexto bem simples. Nós temos o contexto da nossa aplicação, o contexto como um todo, então deixa eu criar um quadrado para isso tudo, e nossa aplicação tem dois contextos. Nós temos o contexto acadêmico, deixa eu colocar um texto nesse círculo. E ele vai se comunicar com o contexto de Gamificação.

[02:24] Nós temos esses dois contextos, e dentro de cada um dos contextos nós temos os conceitos, como, por exemplo, aluno. Um aluno tem um CPF, e nós temos também, em contexto de gamificação, os selos, e o selo precisa saber qual o CPF do aluno. Então nós vamos precisar de alguma forma ter uma interseção entre esses dois contextos, e nessa interseção nós vamos ter o CPF.

[02:57] Olha só aqui no meio desses dois contextos, ou seja, teria que ter esse círculo da esquerda vindo para frente, mas eu não sei fazer isso nessa ferramenta. Nós vamos ter interação, porque o aluno tem CPF, e um selo também vai ter um CPF para identificar de qual aluno é esse selo. Então nós vamos conseguir nos comunicar entre esses dois contextos de uma forma, ou seja, tendo um código compartilhado.

[03:19] Existe também a possibilidade, e é muito comum quando nós trabalhamos com contextos delimitados, essa comunicação não existir entre esses dois contextos, e nós termos uma duplicação, ou seja, nós temos o CPF no contexto acadêmico e nós temos uma outra representação aqui no contexto de gamificação.

[03:42] Isso acontece bastante e essa duplicação permite que nós tenhamos dois contextos realmente separados, em projetos separados, sem nenhum conhecimento entre um e outro. Então são duas abordagens possíveis. De novo, como tudo que nós temos feito até aqui, com vantagens e desvantagens.

[04:02] Essa abordagem do CPF duplicado, desse código duplicado, ela tem vantagem de que nossos dois contextos podem ser separados, podem ser feitos de forma independente, sem nenhuma preocupação. Eu tenho o CPF do aluno aqui e tem um CPF lá também, que eu consigo ter classes separadas sem nenhuma comunicação entre esses dois contextos.

[04:37] Então eu consigo pegar todo esse contexto de gamificação e trazer para fora do sistema, e colocá-lo em um sistema diferente que fornece os dados através de uma API, por exemplo.

[04:53] Agora aquele outro modelo que nós fizemos, nós temos uma vantagem óbvia de não ter a duplicação de código. Nós definimos uma parte compartilhada e onde essa parte é compartilhada, todos os contextos podem acessar.

[05:08] E essa parte compartilhada é a abordagem que nós vamos utilizar, por enquanto, nesse treinamento. Então no próximo capítulo, vamos conversar bastante sobre comunicação entre contextos e como nós fazemos essa parte compartilhada entre contextos.

[05:27] Mas o importante, por enquanto, é entender que nós separamos contextos da nossa aplicação para que eles evoluam de forma independente, para que cada um dos contextos possam, no futuro, virar uma aplicação independente, um serviço próprio, para que um não dependa do outro. Para que eu consiga ter equipes específicas no meu contexto de gamificação e no contexto acadêmico, para que eu consiga separar melhores responsabilidades. E assim, um sistema gigante consiga ser quebrado em menores partes.

[06:02] Faz sentido eu criar bounded contexts, que é o nome desse padrão, eu criar contextos delimitados em um CRUD? Em um cadastro de aluno? Não faz sentido. Não tem necessidade, eu adiciono uma complexidade desnecessária.

[06:15] Agora, em um sistema gigante, em um sistema realmente robusto, se eu defino contextos separados, eu consigo ter equipes específicas para cada um dos contextos, consigo evoluir esses contextos de forma independente, e facilito muito a evolução do sistema.

[06:32] Então essa é a motivação para nós termos bounded contexts ou contextos delimitados, que é um conceito muito importante, muito estudado no DDD. Então no próximo capítulo, como eu já falei, estudaremos um pouco sobre a comunicação entre contextos.

@@06
Para saber mais: Bounded Contexts

Bounded Contexts, ou contextos delimitados, são um dos conceitos mais complexos de entender e implementar do estudo do DDD.
Vale a pena leituras mais aprofundadas para conhecer técnicas que envolvem este princípio.

Aqui deixo um breve artigo com uma introdução ao termo: https://martinfowler.com/bliki/BoundedContext.html.

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima a

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Conhecemos o conceito de Bounded Contexts ou Contextos Delimitados;
Vimos que a separação em contextos nos dá mais flexibilidade porém aumenta (e muito) a complexidade;
Conhecemos o desenho conhecido como Mapa de Contexto;

#### 23/02/2024

@05-Contexto compartilhado

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

https://caelum-online-public.s3.amazonaws.com/1822-DDD-PHP/02/DDD-PHP-projeto-aula-4-completo.zip

@@02
Shared Kernel

[00:00] Boas-vindas de volta a mais um capítulo desse treinamento de introdução aos conceitos de DDD utilizando PHP. E no último capítulo, nós começamos a falar, íamos separar contextos delimitados, ou bounded contexts. E eu comecei, nós fizemos a separação, e entre um vídeo outro, como prometido, eu corrigi os namespaces.
[00:21] Agora eu tenho corretamente Alura\Arquitetura\Academico, e na camada de Aplicacao, módulo de Aluno, etc. Então já corrigi todos os namespaces só fiz um find and replace com a IDE, e também já corrigi a parte de testes, para que quando eu for propor para que você crie testes para o bounded contexts de gamificação, você crie uma pasta diferente também e separe tudo adequadamente.

[00:52] Então com isso definido, está na hora de nós começarmos a conversar sobre a comunicação entre esses bounded contexts. Nós comentamos no nosso mapa de contexto sobre a possibilidade de ter uma parte que é compartilhada entre esses dois módulos. Então essa parte é o que nós vamos criar agora. Essa parte compartilhada que é shared kernel, ou seja, um núcleo compartilhado, uma parte, um contexto compartilhado.

[01:37] Existem inúmeras formas de nós implementarmos isso, e a forma mais simples é junto com cada um dos bounded contexts, ou seja, aqui na raiz, eu vou criar uma pasta chamada "compartilhado", "compartilhamento" ou "shared" que é mais comum esse nome porque vem do padrão shared kernel.

[01:58] Então o que nós vamos ter no nosso núcleo compartilhado? Nós sabemos que nós precisamos do CPF tanto para o contexto de gamificação, quanto para o contexto acadêmico, então eu vou copiar esse Cpf.php por enquanto e no nosso shared kernel, no nosso núcleo compartilhado, eu vou criar uma nova pasta “New > Directory > Name: Domínio”, que vai ser uma pasta de domínio, ou seja, uma parte de domínio que é compartilhado entre os dois e vou colar minha classe de Cpf.

[02:30] E ao invés de estar no contexto Academico, vai estar no contexto shared. Agora nós temos o Cpf pronto para ser compartilhado, então eu posso vir aqui em Indicacao e remover esse Cpf.php, e isso vai quebrar várias coisas, como nós já sabemos.

[02:50] Então mais uma vez, o que eu vou fazer, ao invés de ir em cada um dos lugares, por exemplo, vir aqui no Aluno.php e encontrar todos os lugares onde ele usa CPF, eu vou pesquisar por essa ocorrência e substituir pelo namespace do kernel. Então no PHPstorm é “Ctrl + Shift + R”, então eu vou buscar por esse termo aqui e vou substituir, ao invés de Academico vai utilizar o Shared.

[03:16] Então vai na parte inferior, em substituir todos. Parece que não foi, “Ctrl + Shift + R” de novo, eu coloquei para procurar só no diretório, mas na verdade é no projeto todo. Agora sim deve ir, substituir todos, e agora parece que foi. Vamos ver inclusive aqui se nós temos algum teste para isso, em testes nós tem um CpfTest.php. Então vamos trazer esse teste para fora, no “Shared”.

[03:47] Então nós vamos ter também um domínio, e o nosso “Cpftest.php” vai vir para esse Dominio. Vamos corrigir o teste com os namespaces corretos caso precise, vamos ver, em shared. A princípio é isso mesmo. Então vamos lá, vamos executar nossos testes e garantir que tudo continua passando, que nós não demos nenhuma bobeira. Todos os testes passando, então vamos continuar nosso desenvolvimento.

[04:28] Agora que eu já corrigi os namespaces e as pastas, nós temos agora o que é chamado de núcleo compartilhado. Então mais uma vez, eu tenho o meu contexto acadêmico, tenho o meu contexto de gamificação, e tenho tudo que for compartilhado entre eles que no caso, por enquanto, é só o CPF.

[04:45] Então se nós dermos uma olhada no nosso “Selo.php”, nós já estamos utilizando, opa, ainda não, nós vamos utilizar agora, o shared, ou seja, do contexto compartilhado, nós vamos utilizar o CPF.

[04:48] Então com isso nós resolvemos um problema, mas claro que esse problema não foi totalmente solucionado porque, de novo, se eu quisesse separar o contexto de gamificação como uma aplicação totalmente isolada, nós vamos ter um problema, vamos ter que copiar esse código e trazer para a pasta Gamificacao, alguma coisa do tipo.

[05:16] Mas por enquanto, como nós não temos intenção imediata de realizar essa migração de um bounded context para um projeto separado, isso já resolve o nosso problema. Então essa é uma solução simples, que traz um outro problema, mas resolve momentaneamente o primeiro problema de nós não podermos nos comunicar diretamente com um contexto.

[05:39] Então agora que nós temos o nosso selo, vamos pensar em que momento poderíamos gerar aquele selo de novato, por exemplo. Então vamos conversar sobre isso no próximo vídeo.

@@03
Para saber mais: Shared Kernel

A utilização de um núcleo compartilhado tem suas vantagens e desvantagens.
É a forma mais fácil de possibilitar a comunicação entre contextos delimitados, mas nos tira boa parte da flexibilidade.

Aqui nesse artigo há uma revisão sobre Bounded Contexts e uma breve citação sobre Shared Kernel: http://www.fabriciorissetto.com/blog/ddd-bounded-context/

http://www.fabriciorissetto.com/blog/ddd-bounded-context/

@@04
Ouvintes independentes

[00:00] E agora que nós já entendemos sobre a separação entre contextos delimitados, ou bounded contexts e também aprendemos sobre shared kernel, ou núcleo compartilhado, onde nós temos uma espécie de contexto que pode ser utilizado pelos outros contextos. Vamos implementar uma regra, vamos implementar o caso onde nós geramos um selo, um selo chamado "novato", por exemplo, para um aluno que acabou de ser matriculado.
[00:30] Então se nós vamos gerar um selo quando um aluno foi matriculado, nós vamos acabar utilizando, o que nós queremos é utilizar esse evento aqui, AlunoMatriculado.php. Então vamos implementando e nós vamos nos deparar com vários problemas e, conforme formos nos deparando com esses problemas, eu vou comentando sobre eles.

[00:50] Primeiro, se eu quero lá no meu contexto de gamificação poder ouvir eventos, eu preciso ter acesso a toda essa parte de eventos também. Então eu vou trazer isso tudo -Evento.php, OuvinteDeEvento.php, PublicadorDeEvento.php- lá para o meu contexto compartilhado. Então vou apertar “Ctrl + X” e vou mover para cá, “Dominio > New > Directory > Name: Evento” e eu vou colar aqui, nesse novo diretório.

[01:12] E agora, eu preciso primeiro alterar esse namespace, porque agora não está mais no contexto Academico, está no contexto Shared, e não está direto na raiz do domínio, está em uma pasta Evento. Então vou copiar esse namespace Alura\Arquitetura\Shared\Dominio\Evento, e eu vou colar em OuvinteDeEvento.php e Evento.php.

[01:37] Então com isso o que nós fizemos, nós quebramos os lugares onde utilizavam eventos. Então vamos corrigir só esse local AlunoMatriculado.php. Vamos lá, ele vai utilizar agora do contexto compartilhado. Então podemos até corrigir esse LogDeAlunoMatriculado.php bem rápido, que não vai demorar muito, importei.

[02:03] Então o que eu fiz? Eu movi as classes referentes a Eventos, ou seja, a interface de Evento em si, esse OuvinteDeEvento e o PublicadorDeEvento, eu movi todos eles para o nosso contexto compartilhado, para o nosso núcleo compartilhado e botei dentro de uma pasta “Evento”.

[02:21] Com isso configurado, eu já posso criar aqui no meu contexto de gamificação algo que reaja ao evento de AlunoMatriculado, então vamos lá, deixa eu fechar todas as abas, e abrir em Gamificação, isso vai ser um caso de uso, mesmo que não venha da aplicação vai ser um caso de uso. Então em Aplicacao eu poderia até colocar que é um caso de uso, que houve um evento, então poderia botar em uma pasta chamada evento, mas eu não vou me preocupar com isso.

[02:49] Vamos lá, “Aplicacao > New > PHP Class > Name: GeraSeloDeNovato”, que é o que essa classe vai fazer, ela vai gerar um selo chamado novato. Então vou estender um ouvinte, ou seja, isso vai ser um OuvinteDeEvento, então preciso implementar esses dois métodos, PHPstorm já me dá uma mão. E na linha 12 entra o primeiro problema.

[03:12] A implementação desse método “sabeProcessar” foi feita assim return $evento instanceof AlunoMatriculado, se o evento for da instância de AlunoMatriculado, então ele sabe processar. Mas assim nós teríamos o problema de estar acessando diretamente o outro contexto, o contexto acadêmico e isso fere aquela nossa barreira entre os contextos.

[03:33] Então nós temos duas soluções, eu vou implementar a solução mais fácil e vou deixar como desafio para que vocês implementem a solução, entre aspas, mais bonita. A solução fácil é pegar essa string, que é o nome completo da classe, e garantir que o nome da classe desse evento é igual àquela string grande, ou seja, o nome completo.

[04:00] Então o que eu estou fazendo, na prática, é a mesma coisa, só que eu não estou acessando diretamente o outro contexto, eu não estou utilizando a classe em si outro contexto. Então caso isso aqui vá para projeto, essa string continua a mesma, e eu não vou ter esse problema.

[04:16] Só que eu, obviamente, tenho outro problema. Se o namespace mudar, se o nome da classe mudar, eu vou quebrar esse código. Então isso é um problema, por isso eu vou te deixar a sugestão de implementar a solução mais interessante, que é aqui no “Evento.php”, colocar o nome dele. Por exemplo, todo evento tem que informar seu nome.

[04:40] Então fazendo dessa forma, o nome do evento nós poderíamos buscar de $evento->nome() nós verificaríamos se é igual aluno_matriculado, por exemplo, ou algo do tipo. Vou deixar essa sugestão para que você implemente, mas eu vou seguir essa abordagem da linha 12.

[04:57] Então um problema resolvido, agora chega o outro problema. Nós não podemos acessar de evento, o método CpfAluno, CpfAluno não é um método disponível na interface evento. E para nós gerarmos aquele selo, o selo de Novato, nós precisamos de um Cpf do aluno. Então de novo, nós temos várias soluções possíveis.

[05:19] Uma das soluções é, mesmo o PHP não me garantindo que o que vai vir para esse método é uma instância do evento AlunoMatriculado, eu posso ainda chamar o método diretamente, sem problema, o PHP permite que eu faça isso. O que eu estou fazendo é assumindo o controle e dizendo: “Olha só PHP, mesmo sabendo que esse método pode não existir, eu vou chamar ele.”

[05:42] Então o PHP deixa e o PHPstorm até percebeu que esse método é do evento AlunoMatriculado. Mas uma solução um pouco mais, vamos dizer, flexível, seria aqui no meu evento eu ter algum método chamado, por exemplo, toArray ou algo do tipo. Para Json para array, ou seja, representar um evento em um formato genérico, que não precisa ser de uma classe específica.

[06:15] E na linha 17, eu pegaria, por exemplo, esse toArray e acessaria o cpfAluno. Isso é uma possibilidade. Então vamos fazer isso, só que eu vou fazer isso de uma forma ainda mais interessante. Eu vou fazer com que todo o evento seja serializado como Json. Se é um evento, ele precisa saber se serializar como Json, ele precisa saber ser representado como Json.

[06:38] Então deixa importar isso. Então o que nós vamos fazer com isso, toda a classe que implementar a interface Evento, também implementa a interface JsonSerializable, e essa interface já está dizendo para o meu AlunoMatriculado que falta algo, porque essa interface tem o método JsonSerialize, que devolve uma array ou qualquer dado serializável em Json, mas array é uma possibilidade.

[07:09] Então o que eu vou fazer? Eu vou retornar get_object_vars, ou seja, vou retornar todas as propriedades em um formato de array associativo. Onde a chave cpfAluno vai ter o valor do $cpfAluno, e a chave momento vai ter o momento, vai ter a data e o horário do momento desse evento.

[07:30] Então de forma simples nós resolvemos esse problema, então na linha 17 eu posso chamar o método de JsonSerialize que vai me dar um array e desse array eu posso pegar o $cpf do cpfAluno. É uma solução flexível que mais uma vez, como tudo que nós fizemos aqui, tem suas vantagens e desvantagens.

[07:50] A vantagem é que eu consigo facilmente desacoplar o meu contexto de gamificação em um projeto separado, e esse código das linhas 17 e 18 não vai precisar de modificação nenhuma. Eu continuo pegando o evento como serializado, como um array associativo e continuo pegando o CPF, sem problema.

[08:07] Só que esse CPF, obviamente, teria que vir como uma string, etc. Não vou me preocupar com essas coisas por enquanto. Então agora eu vou gerar o novo selo, esse selo vai receber o CPF do aluno e um nome, que vai ser novato.

[08:25] “Vinícius, mas não seria melhor ter uma classe chamada selo novato, ou então na linha 12 você ter Selo: :Novato, algo assim para não escrever o nome errado?” Seria! Seria o ideal. Nós podemos pensar em modelar isso, mas por enquanto, isso aqui já atinge o meu objetivo, eu não preciso melhorar o design dessa parte.

[08:45] E para salvar esse selo, preciso de um repositório. Então vou receber no construtor, um RepositorioDeSelo, initialize.E nesse RepositorioDeSelo o que eu vou fazer, simplesmente adiciono esse $selo, sem segredo, sem complicação.

[09:10] Agora sempre que o evento AlunoMatriculado for emitido através desse PublicadorDeEvento, nós podemos reagir inserindo e gerando esse novo selo. Só que como nós já vimos, existem vários problemas. Qual é esse problema? Nós precisamos configurar esse PublicadorDeEvento para adicionar esse ouvinte aqui em GeraSeloDeNovato.

[09:33] No nosso caso é muito fácil, nós estamos no mesmo projeto, então em um único projeto nós adicionamos lá naquele nosso naquele container de injeção de dependência, ou no nosso caso, aqui no nosso MatricularAluno, deixa eu apagar isso porque todos os namespaces mudaram, e importar.

[10:00] Então como tudo mudou, todos os namespaces mudaram, eu já trouxe os corretos. Eu poderia no meu $publicador adicionar esse ouvinte de GeraSeloDeNovato() e dentro dos parênteses eu posso aquele RepositorioDeSeloEmMemoria.

[10:22] Com isso, o que eu estou fazendo, aquela minha camada de interface de usuário, ou então esse projeto totalmente que utiliza os meus contextos, ele vai saber configurar os eventos, é possível, como nós estamos vendo aqui, porque isso está fora de cada um dos domínios, isso é uma aplicação separada.

[10:40] Então eu tenho PublicadorDeEventos, tenho ouvintes de contextos separados, ok, isso funciona. E no meu $useCase, quando o $useCase acontecer, ele vai publicar o evento e perfeito, tudo funciona o meu selo vai ser gerado. Vamos ver qual erro está acontecendo, acho que é um problema com namespace.

[11:00] Então aqui nós já temos uma prova, uma amostra de como seria essa comunicação entre dois contextos delimitados. Mas, obviamente, nós temos alguns problemas.

[11:12] Uma parte da nossa aplicação que vai ser, por exemplo, a interface com a web, essa parte da aplicação que é mais ampla vai ter que conhecer todos os contextos. Mas isso é comum. Isso é como se fosse um projeto diferente.

[11:27] Normalmente você tem, como nós falamos na parte de arquitetura, uma pasta chamada “app”, ou “web”, ou algo assim que utiliza todo o projeto que nós criamos aqui. Existiria a possibilidade também, como nós falamos no capítulo anterior, de eu criar um componente que vai ser importado, composer require academico e eu também importo composer require gamificacao, e nesse projeto em que eu importei os dois, realizaria essa configuração.

[11:56] As possibilidades são infinitas, e aqui nós estamos abordando só algumas delas. Mas com isso nós já começamos a implementar a comunicação entre mais de um contexto delimitado.

@@05
Nome dos eventos

Neste vídeo nós começamos a esbarrar em problemas do uso de Bounded Contexts e utilizamos eventos para realizar a comunicação entre eles.
Por que não utilizar diretamente a classe de um evento para saber seu nome? Qual a vantagem de usar a string hard coded?

Performance
 
Alternativa correta
Flexibilidade
 
Alternativa correta! Sem depender diretamente da classe, continuamos com um baixo acoplamento entre os contextos delimitados, nos permitindo estendê-los de forma independente.
Alternativa correta
Segurança

@@06
Fornecendo dados

[00:00] E só para nós consolidarmos conhecimento, vamos fazer uma recapitulação rápida. Nós podemos, e normalmente é comum quando nós trabalhamos com contextos delimitados, quando nós chegamos nesse nível de complexidade da aplicação, é comum que nós tenhamos os contextos como uma aplicação, e o que vai ser servido para o usuário, por exemplo, comandos da linha de comando, o projeto web, a API, isso é um projeto separado. É comum fazer dessa forma.
[00:34] Então nós começamos a entender sobre isso, nós vimos sobre a separação de contextos, vimos sobre o núcleo compartilhado, quando faz sentido utilizar, enfim. Nós já temos entendido bastante coisa. Então para consolidar o que nós vimos, inclusive no treinamento de arquitetura, vamos criar um novo use case, um caso onde nós podemos fornecer os selos de determinado usuário.

[00:58] Vamos lá, “Aplicacao > New > Directory > Name: BuscarSelosDeUsuario”, e aqui nós vamos ter, “BuscarSelosDeUsuario > New > PHP Class > Name: BuscarSelosUsuarioDto”, e uma classe que vai realmente executar isso, “BuscarSelosDeUsuario > New > PHP Class > Name: BuscarSelosUsuario”.

[01:28] Então o nosso “Dto”, o que nós precisamos, só do CPF do aluno. Então vamos lá, um construtor onde nós vamos receber, deixa eu criar a propriedade antes, public Cpf $cpfAluno, só que lembra que um “Dto” não utiliza tipos do nosso domínio, então vamos receber uma string. Então out insert, vou gerar o construtor inicializando o CPF.

[01:57] Já temos o nosso “Dto”, agora para buscar os selos de usuário, eu preciso de um RepositorioDeSelo, vou inicializar. Nós podemos executar esse caso de uso recebendo o BuscarSelosUsuarioDto, ou seja, os $dados.

[02:18] Então através desse nosso repositório, já poderíamos diretamente buscar os selos do aluno? Ainda não, nós precisamos criar um CPF a partir dos dados. Agora sim, nós podemos passar o CPF do aluno e pegar todos os selos. Então nós poderíamos retornar diretamente esses selos, formatados como Json,json_encode, nós poderíamos devolver eles no formato de xml, como nós preferirmos.

[02:51] Mas como isso aqui é um caso de uso, não está se comunicando diretamente com o mundo exterior, eu vou retornar diretamente essa lista, esse array de selos. Deixa eu ver qual o problema que ocorreu na linha 27, ele está utilizando o CPF no namespace errado, corrigido.

[03:11] Agora nós temos um caso de uso em outro contexto, ou seja, eu poderia, na minha API, nós fornecermos um novo end point, por exemplo, um end point que informe todos os selos de um usuário em Json, e nós poderíamos utilizar esse use case.

[03:27] Então dessa forma nós entendemos que há pontos de entrada em diferentes contextos. Em um contexto eu estou buscando os selos, em outro contexto eu estou matriculando alunos, então nós conseguimos separar os casos de uso de cada um dos contextos e eles não precisam se conhecer para funcionar, e esse é o ponto principal.

[03:49] Nós temos que poder, a qualquer momento, separar o nosso contexto acadêmico do nosso contexto gamificação em projetos separados sem modificar muita coisa. Óbvio que vão ser necessárias modificações, nós estamos utilizando um núcleo compartilhado, que dificultaria um pouco, mas nós conseguimos fazer essa separação sem muito problema, sem muito trabalho.

[04:13] Então com esse novo caso de uso implementado, eu vou deixar, obviamente, como sempre tenho feito, um exercício para que você crie um teste para ele. Você simplesmente precisa garantir que em um repositório, que tenha algum selo para algum aluno, esse caso de uso retorna esse selo.

[04:31] Então com esse desafio, no próximo capítulo nós voltamos para bater um papo, não vai colocar mais a mão na massa, mas nós vamos conversar bastante sobre como nós podemos evoluir uma aplicação separada dessa forma.

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Entendemos que os contextos devem ser independentes, mas precisam se comunicar de alguma forma;
Conhecemos o conceito de Shared Kernel, e vimos que há vantagens e desvantagens;
Utilizamos eventos de domínio para realizar parte da comunicação entre contextos;
Vimos que cada contexto pode fornecer seus Use Cases de forma independente.

#### 22/02/2024

@06-Camada anticorrupção

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

https://caelum-online-public.s3.amazonaws.com/1822-DDD-PHP/02/DDD-PHP-projeto-aula-5-completo.zip

@@02
Sistemas distribuídos

[00:00] Boas-vindas de volta a esse que é o último capítulo desse nosso treinamento de introdução a alguns conceitos de Domain Driven Design, ou DDD, utilizando PHP. Nesse capítulo eu quero bater um papo com vocês, embora vocês não estejam vendo meu rosto espero que vocês prestem bastante atenção. E vamos conversar um pouco sobre como isso aqui, como essa estrutura de contextos delimitados separados pode acabar evoluindo.
[00:26] Nós temos no nosso caso, um sistema que possui todas as regras do nosso contexto acadêmico, do nosso contexto de gamificação e nós, junto aqui do mesmo projeto, temos uma outra estrutura que fornece acesso a isso. Seja através de comandos, nós poderíamos estar utilizando um framework web aqui. E aí teria uma pasta web e uma pasta app, que forneceria acesso um ponto de entrada a todos os nossos use cases.

[00:55] Isso eu acredito que isso esteja claro até aqui, caso não tenha ficado claro até essa parte, vamos lá, nós vamos para o fórum respondemos todas as dúvidas, e depois voltamos aqui para esse ponto.

[01:05] Tendo isso tudo em mente, como que isso pode acabar evoluindo? Primeiro, para um projeto chegar nesse nível de complexidade, de dificuldade, porque olha só a nossa estrutura como está, olha quanta coisa nós temos, quantas classes, quantos detalhes nós temos na nossa aplicação. Eu estou abrindo e não para de chegar. E nossa aplicação ainda não tem basicamente nada, ela está muito simples, mas mesmo muito simples nós já temos esse número enorme de arquivos, fora os testes.

[01:36] Então você repara que a complexidade aumenta muito quando nós seguimos por esse caminho. E para valer a pena a complexidade aumentar nesse ponto, nós precisamos ter um sistema realmente complexo, onde essa separação justifique, e ao invés de complexidade ela simplifique. Fazendo com que nós possamos dividir equipes em contextos diferentes. Eu tenho uma equipe específica para gamificação, eu tenho uma equipe específica para o contexto acadêmico.

[02:07] Então dessa forma nós só vamos implementar esse tipo de arquitetura, esse tipo de técnica de separação quando nosso projeto realmente pedir, quando for necessário. Nós não vamos fazer um crud separando contextos assim, não faz sentido e não vale a pena.

[02:23] Então levando em conta que para um sistema chegar nesse nível de complexidade existe ainda uma espécie de evolução que seriam sistemas distribuídos. Eu não vou implementar nada de sistemas distribuídos, porque fugiria completamente do foco desse treinamento.

[02:41] Mas basicamente um sistema distribuído, muito basicamente, seria a parte acadêmica está no sistema, em um servidor rodando, por exemplo, um projeto em “Symphony”. E a parte de gamificação está rodando em outro servidor, um outro domínio, rodando um projeto em “Falcon” ou “Lumen”, alguma coisa assim.

[03:04] Então nós teríamos projetos diferentes, com programas diferentes, com tecnologias diferentes, em servidores diferentes, então nós distribuiríamos a nossa aplicação em vários locais, vários servidores.

[03:17] E se nós criamos, se nós começamos o nosso projeto separando ele dessa forma, fica muito mais fácil distribuí-lo depois. Porque para eu separar esses projetos em dois, é fácil. Para cada um desses contextos eu crio um projeto separado e disponibilizo eles, para que eles sejam “instalados”, entre aspas utilizando composer, e com isso fica bem mais tranquilo de importar para um lugar ou para outro.

[03:45] Então essa forma de estruturar facilita muito para que nós distribuamos nosso sistema, e um sistema distribuído tem, obviamente, como tudo que nós fizemos até aqui, vantagens e desvantagens. Em um sistema distribuído, nós sabemos que normalmente o nosso sistema acadêmico vai ter mais requisições, vai precisar de mais recursos do que o nosso sistema de gamificação.

[04:10] Por dois motivos, é muito mais fácil um aluno estar se matriculando, ou assistindo cursos, esse tipo de coisa, do que está ganhando selos, acontece com muito mais frequência. E além disso é muito mais importante que nossos alunos consigam acessar seus cursos, seus treinamentos do que eles vejam seus selos. Então caso o sistema de gamificação saia do ar, nenhum aluno vai correr para cancelar matrícula. Agora se o sistema acadêmico sai do ar um problema é muito maior.

[04:40] Então nós podemos direcionar mais recursos para esse contexto, para esse sistema acadêmico, enquanto esse sistema de gamificação, embora seja importante, não faça parte, não seja tão crucial para o funcionamento da aplicação.

[04:50] Então imagina que em uma black friday, nós temos muitas matrículas, nós podemos reduzir custos, tirando um pouco dos recursos desse contexto, desse sistema de gamificação, e alocando para esse sistema acadêmico. Então nós ganhamos nesse ponto, só que para gerenciar isso é muito complexo.

[05:08] Você provavelmente já ouviu o termo "microsserviços", microsserviços é uma arquitetura, uma forma de organizar sistemas distribuídos onde cada um dos sistemas tem propósitos bem específicos e são contextos pequenos e bem delimitados. É uma forma de manter seu sistema distribuído muito escalável só que a complexidade aumenta absurdamente, você tem muito mais problemas do que teria no sistema chamado de monolítico como nós temos feito até aqui.

[05:38] Então tudo tem vantagens e desvantagens, e nós precisamos saber pesar, nós precisamos saber medir o que faz sentido para cada uma das aplicações. Sei que esse é um conceito bastante complexo, mas vale a pena a leitura também, é um assunto que eu tenho estudado hoje, é um assunto que eu não domino particularmente, por isso tenho estudado bastante.

[05:59] E quando nós entramos nesse cenário de sistemas distribuídos, a comunicação entre dois contextos muda um pouco. Então no próximo vídeo, mais uma vez é um bate-papo, nós vamos conversar um pouco sobre a comunicação entre sistemas distribuídos.

@@03
Sobre os sistemas distribuídos

Entendemos que contextos delimitados podem acabar evoluindo nosso sistema para se tornar um sistema distribuído.
O que é um sistema distribuído, na prática?

É um sistema que embora pareça ser um para o usuário, é constituído de vários outros sistemas menores
 
Alternativa correta! Os famosos microsserviços são um tipo de sistemas distribuídos. Com sistemas distribuídos você ganha muitas vantagens porém também há desvantagens, como foi citado no vídeo
Alternativa correta
É um sistema que distribui a carga de todas as requisições
 
Alternativa correta
É um sistema que tem várias URLs para o usuário acessar

@@04
Camada anticorrupção

[00:00] Voltando naquele nosso papo de sistemas distribuídos, imagina que nós temos dois sistemas diferentes, o nosso contexto acadêmico sendo servido como uma aplicação web, e o nosso contexto de gamificação sendo servido só como uma API Restful, não tem formulários, não tem muita interface.
[00:21] Então o que acontece? Sempre que um aluno se matricular, preencheu um formulário e se matriculou, imagina que aqui no nosso lado esquerdo, nós temos um contexto acadêmico, e do lado direito nós temos um contexto de gamificação.

[00:33] O nosso contexto acadêmico vai fazer o quê? Ele vai publicar aquele evento AlunoMatriculado em um sistema de mensagens, de fila de mensagens. Ele vai publicar aquilo e falar: “Um aluno foi matriculado." Caso alguém se interesse por isso, está aí na nossa lista de mensagens. E volta, devolve para o usuário a resposta falando que ele foi matriculado com sucesso, e vida continua.

[00:57] E nessa fila de mensagens, vão ter várias mensagens, vários eventos, várias informações como um aluno matriculado, um aluno que cancelou a matrícula, uma indicação que aconteceu, talvez um novo selo foi gerado para algum aluno, várias mensagens acontecendo.

[01:16] E aí os chamados receptores, os que estão lendo essas mensagens podem ver: “Tem aqui alguma mensagem dizendo que teve um aluno matriculado? Opa, essa mensagem que diz isso.” Então vou pegar essa mensagem, vou abrir e eu pego o CPF desse aluno e gero um novo selo, e salvo na minha base de dados. Ou seja, é inclusive possível através de sistemas distribuídos, que tenham bases de dados diferentes.

[01:43] Aqui o nosso sistema acadêmico tem uma base de dados com os alunos, cursos, indicações. E nossa base de dados de gamificação tem pontos, selos, etc, e só relaciono utilizando o CPF. E esse relacionamento, esse CPF, é justamente o que pode ser chamado de camada de anticorrupção, não só o CPF, claro, mas uma camada, algumas classes que nós adicionamos que conhecem os dois lados.

[02:10] Ou seja, eu teria aqui uma classe que conheceria, que entenderia o CPF de um aluno, para saber formatar ele caso fosse preciso fazer qualquer transformação para salvar esse CPF aqui no nosso contexto de gamificação. Então essa transformação, essa comunicação mais direta entre um contexto e outro, essa parte que conhece os dois contextos é chamada de camada de anticorrupção.

[02:36] E quando nós temos distribuição de sistemas, quando nós temos sistemas distribuídos, essa camada de anticorrupção é muito necessária e existem várias formas de implementar, como simples classes de tradução, ou um sistema inteiro rodando aqui na frente. Então é um conceito, de novo, que vai além do escopo deste treinamento, mas que os livros de DDD citam então obviamente nós precisamos citar para que você conheça o termo.

[03:02] Como muitas das coisas que eu comentei nesse curso, eu disse que vale a pena uma leitura mais aprofundada, no próximo vídeo eu volto com algumas referências de livros, artigos talvez, como eu já deixei em exercícios anteriores alguns artigos, para que você continue esse estudo na área de Domain Driven Design, na área de arquitetura. Para que você aprofunde seu conhecimento além do que esse treinamento já te deu.

@@05
Acaba aqui?

[00:00] Esse vídeo não é propaganda nem nada, mas eu não posso deixar de citar as referências que eu vou citar aqui.
[00:08] Existem alguns livros e alguns autores muito conhecidos no ramo de DDD, o principal livro e foi o livro que originou esse estudo é esse daqui “Domain-Driven Design: Tackling Complexity in the Heart of Software”, ou seja, design guiado ao domínio: atacando a complexidades no coração do software, ou seja, começando pelo domínio, pelo mais importante. Então esse livro foi o que originou todo esse estudo de DDD e foi criado pelo Eric Evans, foi ele quem escreveu esse livro.

[00:42] E ele também lidera esse projeto “Domain Language”. Vale a pena acessar esse site, ver algum dos conteúdos que tem aqui, tem alguns artigos, é muito interessante. Vale a pena, é gratuito.

[00:56] Só que esse livro do Eric Evans tem uma leitura, vamos dizer, cansativa. É uma leitura um pouco mais pesada. Então pensando nisso e para simplificar um pouco, o Vaughn Vernon escreveu um livro chamado “Implementing Domain-Driven Design”, ou seja, implementando o design guiado a domínio. Então é uma espécie de releitura do livro do Eric Evans com uma linguagem um pouco mais simples de ler, vamos dizer dessa forma.

[01:31] Então esse livro que possui mais ou menos o mesmo conteúdo do livro do Eric Evans com uma linguagem um pouco mais fácil. Então aqui também tem todos os conceitos teóricos e uma parte prática do DDD. É bem interessante.

[01:45] E o Vaughn Vernon tem esse site acessível neste link. Onde você consegue ver eventos em que ele participa, workshops que ele já deu, palestras, tem bastante conteúdo que também vale a pena.

[01:56] E como nós estamos falando de DDD, eu não poderia deixar de citar o livro “DDD em PHP”. Esse livro “DDD in PHP”, ou “DDD em PHP”, é exatamente isso. É a implementação DDD utilizando PHP, é a implementação dos padrões táticos utilizando PHP.

[02:21] E nesse livro, que eu recomendo demais a leitura, nós vemos bastante coisa do que eu já falei aqui, só que com muito mais detalhes. Como por exemplo, aquelas estratégias que eu citei sobre persistência, transação e consistência dos dados ao persistir aggregates, aqui tem um capítulo bem interessante sobre isso. Comunicação entre bounded contacts tem um capítulo específico sobre isso, um capítulo para só para domain events.

[02:55] Tem muitos exemplos práticos e utilizando PHP, e a linguagem utilizada nesse livro, a forma que é falada é muito simples. É um livro que eu não sei se existe a tradução para português eu só li a versão em inglês, mas eu recomendo muito a leitura. Vale muito a pena.

[03:11] E falando em idioma, em português ou inglês, existe um canal de um ex instrutor aqui da Alura inclusive, o Alberto Souza, e ele pública bastante conteúdo no canal do YouTube dele, Dev Eficiente acessível neste link, e eu recomendo demais. Um dos últimos vídeos é justamente sobre o que eu comentei da realidade do DDD, que nós nem sempre precisamos implementar isso tudo, separar contextos, fazer tudo isso que o DDD ensina nas nossas aplicações do dia a dia.

[03:40] Existem outros vídeos específicos sobre DDD, como por exemplo service, esse vídeo onde ele fala sobre o pattern que foi definido no livro, mas que hoje em dia é mal utilizado, enfim. É um canal chamado “Dev Eficiente”, muito interessante que eu também recomendo a leitura.

[03:58] Então com isso tudo, com essa enxurrada de referências, o que eu quero dizer é que esse treinamento foi realmente uma introdução, você só tá colocando o pé nesse oceano que é o estudo de DDD, de arquitetura, de design orientado a objetos.

[04:15] Então nós, embora tenhamos falado sobre muita coisa, tenha sido um conteúdo já denso e meio avançado, tem muito mais coisa para estudar. Então eu tenho pouco hábito de leitura, mas eu tenho adquirido, justamente por causa desses estudos, estudos para nós conseguirmos ler na fonte, como ler o livro do Eric Evans, vale a pena. Ler esse livro específico em DDD vale muito a pena.

[04:40] E o Alberto Souza é uma das pessoas que estão fazendo esse trabalho de entregar informação de forma um pouco mais simples para nós, então recomendo demais.

[04:49] Existe muito conteúdo legal, vale a pena pesquisar. Durante o treinamento deixei alguns artigos sobre pontos específicos, pesquise mais sobre esses autores e no próximo vídeo é aquele tchau!

@@06
Para saber mais: Referências

DDD é um assunto com muito conteúdo e seria impossível colocar tudo em cursos em vídeo. Há vários livros que são “leituras obrigatórias” para quem quer se aprofundar na área.
O livro que originou o termo DDD: https://www.amazon.com.br/dp/B00794TAUG/ref=dp-kindle-redirect?_encoding=UTF8&btkr=1
Uma releitura com uma linguagem um pouco mais palatável: https://www.amazon.com.br/Implementing-Domain-Driven-Design-English-Vaughn-ebook/dp/B00BCLEBN8/ref=reads_cwrtbar_2/136-2192446-3149439?_encoding=UTF8&pd_rd_i=B00BCLEBN8&pd_rd_r=1b2f1be2-3f0c-40e3-929b-21cd85850dfc&pd_rd_w=mbTue&pd_rd_wg=N9ZBi&pf_rd_p=fcd5cfce-70d2-4fb2-84e0-1100e88dded2&pf_rd_r=A5H4RARTFWM0QB02JWYS&psc=1&refRID=A5H4RARTFWM0QB02JWYS
Um livro prático sobre implementação em PHP de conceitos do DDD: https://leanpub.com/ddd-in-php
Há ainda diversos canais do YouTube, blogs e sites que falam sobre DDD. Vale a pena a pesquisa.

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com os próximos cursos que tenham este como pré-requisito.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

O que aprendemos nessa aula:
Conversamos sobre o que é um sistema distribuído;
Vimos que através de contextos delimitados podemos distribuir sistemas realmente complexos;
No caso de sistemas distribuídos, falamos que há a necessidade de uma camada anti-corrupção;
Vimos algumas referências para nos aprofundar no assunto de DDD.

@@09
Conclusão

[00:00] Parabéns por ter chegado até o final desse treinamento. Sei que foi um treinamento meio denso, com alguns conceitos que eu não pude me aprofundar muito, mas é um conteúdo muito importante, eu realmente espero que você tenha entendido esse básico e tenha interesse em se aprofundar, procure mais conteúdo sobre.
[00:18] Então, recapitulando o que nós vimos, começamos só com essa parte - "Aplicacao", "Dominio", "Infra" - do nosso projeto, onde nós vimos muitos conceitos de arquitetura no treinamento anterior, revimos e fomos implementando mais coisas.

[00:30] Nós entendemos que um aggregate root é feito através de invariantes entre relacionamentos, nós entendemos que um aggregate root não é uma coleção, nós vimos essa diferença, implementamos a lógica e falamos sobre a persistência disso. Fica aí mais uma vez a dica de estudar sobre consistência na persistência de aggregate root.

[00:55] E nós avançamos nossos estudos, nós falamos sobre eventos de domínio, nós entendemos como implementar eventos de domínios, como publicar, como ouvir esses eventos. E para isso nós criamos algumas classes próprias para tratar eventos. Existem pacotes que te ajudam no desenvolvimento dessa parte de domínios, mas o que nós fizemos aqui é bem próximo do que acontece na vida real.

[01:20] Além de eventos de domínio, além de entidades aggregates value objects, nós começamos a falar de uma parte mais arquitetural e estratégica, onde nós separamos nosso projeto em contextos. Esses contextos precisam de uma barreira, por isso são chamados de contextos delimitados, bounded context.

[01:38] Esses contextos delimitados, em via de regra não devem se conhecer, não devem falar um com o outro. E quando isso é necessário, existem estratégias. Se nós estamos falando de um sistema distribuído como nós conversamos bastante, nós podemos fornecer uma API, nós podemos fornecer dados através de uma API RESTful, por exemplo, ou mensageria como nós comentamos também, utilizando os eventos para se comunicar.

[02:03] Mas como no nosso caso é um sistema separado em contextos mas um sistema monolítico, nós pudemos utilizar a técnica chamada de shared kernel, ou núcleo compartilhado. Que nada mais é do que um contexto onde todos os outros contextos podem acessar.

[02:19] E com isso nós chegamos no ponto da conversa de comunicação entre bounded contexts, separação em sistemas distribuídos, nós conversamos bastante sobre isso e eu espero honestamente que você tenha ficado com dúvidas. Porque se você tiver entendido tudo de cara, só com as minhas explicações, quer dizer que esse conteúdo foi muito raso. Então espero que você tenha dúvidas.

[02:42] Espero que você compartilhe suas dúvidas comigo no fórum, eu tento responder pessoalmente sempre que possível, mas quando eu não consigo a nossa comunidade de alunos e nossos moderadores são muito solícitos, então eles, com certeza, vão ajudar você.

[02:58] Mais uma vez parabéns por ter chegado até aqui, espero que você tenha gostado. Muito obrigado por ter me acompanhado e me aturado até esse ponto, espero te ver em outros treinamentos aqui na Alura. Forte abraço e tchau!
