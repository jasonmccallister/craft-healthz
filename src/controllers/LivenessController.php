<?php

/**
 * Health Check plugin for Craft CMS 3.x
 *
 * Add health checks to your Craft website, useful when running inside of Docker
 *
 * @link      https://mccallister.io
 * @copyright Copyright (c) 2019 Jason McCallister
 */

namespace mccallister\healthz\controllers;

use Craft;
use craft\web\Controller;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Jason McCallister
 * @package   HealthCheck
 * @since     1.0.0
 */
class LivenessController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/healthz/liveness
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $response = Craft::$app->getResponse();

        $response
            ->getHeaders()
            ->set('Cache-Control', 'no-cache, no-store, must-revalidate');

        if (Craft::$app->db->isActive) {
            return $this->asJson(['message' => 'ok']);
        }

        $response->setStatusCode(400);

        return $this->asErrorJson('could not establish connection to database');
    }
}
