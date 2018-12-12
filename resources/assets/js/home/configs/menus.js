export default [
	{
		label: 'Inicial',
		uri: {
			name: 'home'
		}
	},
	{
		label: 'Notícias',
		dropdown: true,
		subMenus: [
			{	
				label: 'Ultímas noticias',
				uri: {
					name: 'posts'
				}
			},
			{	
				label: 'Categorias',
				uri: {
					name: 'categories'
				}
			}
		]
	},
	{
		label: 'Programação',
		uri: {
			name: 'programming'
		}
	}
]